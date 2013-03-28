/*
# This file is part of Z-Wave.Me Z-Way Demo UI.
#
# Copyright (C) 2013 Poltorak Serguei, Z-Wave.Me
#
# Z-Way Demo UI is free software: you can redistribute it and/or modify
# it under the terms of the GNU General Public License as published by
# the Free Software Foundation, either version 3 of the License, or
# (at your option) any later version.
#
# Z-Way Demo UI is distributed in the hope that it will be useful,
# but WITHOUT ANY WARRANTY; without even the implied warranty of
# MERCHANTABILITY or FITNESS FOR A PARTICULAR PURPOSE.  See the
# GNU General Public License for more details.
#
# You should have received a copy of the GNU General Public License
# along with Z-Way Demo UI.  If not, see <http://www.gnu.org/licenses/>.
*/

var tbl;

// Holder for Z-Wave data tree comming from Z-Way server
var ZWaveAPIData = { updateTime: 0 };

// Init
$(document).ready(function() {
	// Set periodical updates
	setInterval(getDataUpdate, 500);


	// Init ZWaveAPIData structure
	$.triggerPath.init(ZWaveAPIData);

	// Set triggers on devices, instances and commandCasses list change
	$.triggerPath.bindPathNoEval('devices,devices[*],devices[*].instances,devices[*].instances[*],devices[*].instances[*].commandClasses,devices[*].instances[*].commandClasses[*]', function(obj, path) {
		showDevices();
	});

	// shortcut to table object
	tbl = $('div.razberry');
	
	
	//showDevices();

	// On Server Change button press update server URL and login/password
	
	
	// Apply jQuery button design
	$('button').button();
});

// Render list of all devices and their functions
function showDevices() {
	tbl.empty();
	
	
                                
	$.each(ZWaveAPIData.devices, function (nodeId, node) {
		
		var controllerNodeId = ZWaveAPIData.controller.data.nodeId.value;
		if (nodeId == 255 || nodeId == controllerNodeId)
			// We skip broadcase and self
			return;

		// Device status and battery
		var basicType = node.data.basicType.value;
		var genericType = node.data.genericType.value;
		var specificType = node.data.specificType.value;
		var isListening = node.data.isListening.value;
		var isFLiRS = !isListening && (node.data.sensor250.value || node.data.sensor1000.value);
		var hasWakeup = 0x84 in node.instances[0].commandClasses;
		var hasBattery = 0x80 in node.instances[0].commandClasses;
		
		// For all instances
		$.each(node.instances, function(instanceId, instance) {
			if (instanceId == 0 && $.objLen(node.instances) > 1)
				return; // We skip instance 0 if there are more, since it should be mapped to other instances or their superposition

			// Switches
			// We choose SwitchMultilevel first, if not available, SwhichBinary is choosen
			if (0x26 in instance.commandClasses) {
				insertSwitch(nodeId, instanceId, 0x26, '');
			} else if (0x25 in instance.commandClasses) {
				insertSwitch(nodeId, instanceId, 0x25, '');
			}

			
		});
		
	});
	$('button').button();
	
};

// Insert row for SwitchBinary and SwitchMultilevel
function insertSwitch(nodeId, instanceId, ccId, control_html) {
	// Add new line
	
	var nodeTr = $('<div id="device' + nodeId + '" device="' + nodeId + '" class="device_header"><div id="level"></div></div>');
		
	// Trigger update on changes
	nodeTr.find('#level').bindPath('devices[' + nodeId + '].instances[' + instanceId + '].commandClasses[' + ccId + '].data.level', updateLevel, ccId , nodeId, instanceId);

	// Append it
	tbl.append(nodeTr);
};

// Callback on button press for a Switch
function switchButtonAction() {
	var path = $(this).children("#butt");
	var nodeId = path.attr('device');
	var instanceId = path.attr('instance');
	var ccId = path.attr('commandClass');
	
	var val = 0;
	var cur = ZWaveAPIData.devices[nodeId].instances[instanceId].commandClasses[ccId].data.level.value;
	
	if (path.hasClass('off'))
		val = 0;
	else if (path.hasClass('on'))
		val = 255;
	else if (path.hasClass('max'))
		val = 99;
	else if (path.hasClass('plus'))
		val = ((cur + 10) <= 100) ? cur + 10 : 100;
	else if (path.hasClass('minus'))
		val = ((cur - 10) >= 0) ? cur - 10 : 0;
		
	runCmd('devices[' + nodeId + '].instances[' + instanceId + '].commandClasses[' + ccId +'].Set(' + val +')');
};

// Binding function for switches level update
function updateLevel(obj, path, ccId, nodeId, instanceId) {
	var level_html;
	var level_color;
	
	var level = obj.value;
	//alert (level);
	if (level === '' || level === null) {
		level_html = '?';
		level_color = 'gray';
	} else {
		level = parseInt(level, 10);
		if (level == 0) {
			level_html = '<img src="/images/LampOff.png" id="butt" class="on" device="' + nodeId + '" instance="' + instanceId +'" commandClass="' + ccId + '">';
			level_color = 'black';
		} else if (level == 255 || level == 99) {
			level_html = '<img src="/images/LampOn.png" id="butt" class="off" device="' + nodeId + '" instance="' + instanceId +'" commandClass="' + ccId + '">';
			level_color = '#FFCF00';
		} else {
			level_html = '<img src="/images/LampOn.png" id="butt" class="off" device="' + nodeId + '" instance="' + instanceId +'" commandClass="' + ccId + '"><div id="dim">' + level.toString() + ((ccId == 0x26) ? '%' : '' + '</div>');
			var lvlc_r = ('00' + parseInt(0x9F + 0x60 * level / 99).toString(16)).slice(-2);
			var lvlc_g = ('00' + parseInt(0x7F + 0x50 * level / 99).toString(16)).slice(-2);
			level_color = '#' + lvlc_r + lvlc_g + '00';
		}
	};
	$(this).html(level_html).bind('click', switchButtonAction);
	//$(this).parent().find('#updateTime').html(getUpdated(obj));
};

// POST JSON function
$.postJSON = function(url, data, callback, sync) {
	// shift arguments if data argument was omited
	if ( jQuery.isFunction( data ) ) {
		sync = sync || callback;
		callback = data;
		data = {};
	};
	$.ajax({
		type: 'POST',
		url: server_host + url,
		data: data,
		dataType: 'json',
		success: callback,
		error: callback,
		async: (sync!=true),
		beforeSend : function(req) {
			if (server_auth)
				req.setRequestHeader('Authorization', server_auth);
		}
       	});
};

// Prepare token for Basic Auth
function make_basic_auth(user, password) {
	if (user == '')
		return '';
	
	var tok = user + ':' + password;
	var hash = Base64.encode(tok);
	return "Basic " + hash;
}

// Prepare new server URL and login/passwd
var server_host = 'http://192.168.1.103:8083';
var server_auth = '';
ZWayServerChange = function(host, user, pwd) {
	server_host = 'http://192.168.1.103:8083';
	server_auth = make_basic_auth(user, pwd);
	ZWaveAPIData.updateTime = 0; // Fetch all data from server
};

// len function
$.objLen = function objLen(obj) { var l = 0; for (name in obj) l++; return l; };

// holder for all data
var ZWaveAPIData = { updateTime: 0 };

// Get data holder element
function getDataHolder(data) {
	var r = '<div class="Data">';
	r += '<div class="DataElement">' + data.name+': <font color="' + ((data.updateTime > data.invalidateTime) ? 'green' : 'red') + '">'+((typeof(data.value) !== 'undefined' && data.value != null)?data.value.toString():'None')+'</font>' + ' (' + getUpdated(data) + ')</div>';

	$.each(data, function (key, el) {
		if (key != 'name' && key != 'type' && key != 'updateTime' && key != 'invalidateTime' && key != 'value' && // these are internal values - skip them
				key != 'ZDDXML' && key != 'ZDDXMLLang' && key != 'capabilitiesNames') // these make the dialog monstrious - skip them
			r += getDataHolder(el);
	});

	r += '</div>';
	return r
};

// Shows Data Holder in a dialog
function showDataHolder(data) {	
	$('div.DataHolder').html(getDataHolder(data))
		.css({'max-height': $(document.body).height()-128, height: 'auto'})
		.dialog({
			modal: true,
		       	title: 'Command class data',
		       	width: 'auto',
		       	buttons: {
		       		ok : function() {
			       		$(this).dialog("close");
				}
			}
		});
};

// Show interview results in a dialog
function showInterviewResults(nodeId) {	
	var interviewResults;
	$('#interview_result')
		.bindPath('devices[' + nodeId + '].instances[*].commandClasses,devices[' + nodeId + '].instances[*].commandClasses[*].data.interviewDone', function() {
			interviewResults = $('<table id="interviewResultsTable"><tr><td>Instance</td><td>Command Class</td><td>Result</td></tr></table>');
			for (var iId in ZWaveAPIData.devices[nodeId].instances)
				for (var ccId in ZWaveAPIData.devices[nodeId].instances[iId].commandClasses) {
					ccResult = $('<tr><td align="center"><a href="#" class="a_instance">' + iId + '</a></td><td><a href="#" class="a_command_class">' + ZWaveAPIData.devices[nodeId].instances[iId].commandClasses[ccId].name + '</a></td><td>' + (ZWaveAPIData.devices[nodeId].instances[iId].commandClasses[ccId].data.interviewDone.value? 'Done': '<button class="run geek"></button>') + '</td></tr>');
					(function(nodeId, iId) {
						ccResult.find('a.a_instance').bind("click", function() { showDataHolder(ZWaveAPIData.devices[nodeId].instances[iId].data); });
					})(nodeId, iId);
					(function(nodeId, iId, ccId) {
						ccResult.find('a.a_command_class').bind("click", function() { showDataHolder(ZWaveAPIData.devices[nodeId].instances[iId].commandClasses[ccId].data); });
						ccResult.find('.run').bind("click", function() { runCmd('devices[' + nodeId + '].instances[' + iId + '].commandClasses[' + ccId + '].Interview()'); }).html('Force interview').button();
					})(nodeId, iId, ccId);
					interviewResults.append(ccResult);
				}
			 $(this).html('Interview results' + ': <a href="#" class="a_device">' + nodeId + '</a><br /><br />').append(interviewResults);
			 $('#interview_result').find('a.a_device').bind("click", function() { showDataHolder(ZWaveAPIData.devices[nodeId].data); });
		})
		.append(interviewResults) // hack to render dialog size
		.css({'max-height': $(document.body).height()-128})
		.dialog({
			modal: true,
		       	title: 'Interview results',
			width: 'auto',
		       	buttons: {
				ok : function() {
					$(this).dialog("close");
				}
			}
		});

};

// Run ZWaveAPI command via HTTP POST
function runCmd(cmd, success_cbk) {
	$.postJSON('/ZWaveAPI/Run/'+ cmd, function (data, status) {
		if (status == 'success' || status == '') {
			if (success_cbk) success_cbk();
			if (data) console.log(data);
		} else
			alert_dialog('Command execution failed: ' + data.statusText);
	});
	return 'sent';
};

// Get updates data from ZWaveAPI via HTTP POST
var running_getDataUpdate = false; // in case request would take more than interval between subsequent requests
function getDataUpdate(sync) {
	if (!running_getDataUpdate) {
		running_getDataUpdate = true; // begin task
		$('.updateTimeTick').addClass('red');
		$.postJSON('/ZWaveAPI/Data/' + ZWaveAPIData.updateTime, handlerDataUpdate, sync);
	}
};

// Callback of getDataUpdate: handles diff changes returned by server
function handlerDataUpdate(data, status) {
	if (status != 'success' || data == null) {
		running_getDataUpdate = false; // task done
		error_msg('Error connecting to server: ' + status + ' ' + data.status);
		return;
	};
	
	error_msg('');

	try {
		// handle data
		$.each(data, function (path, obj) {
			var pobj = ZWaveAPIData;
			var pe_arr = path.split('.');
			for (var pe in pe_arr.slice(0, -1))
				pobj = pobj[pe_arr[pe]];
			pobj[pe_arr.slice(-1)] = obj;
			
			$.triggerPath.update(path);
		});
	} catch(err) {
		error_msg('Error during data update', err.stack);
	};
	
	running_getDataUpdate = false; // task done

	// update time button. we are doing it here and not using bindPath to save resources
	$('.updateTimeTick').removeClass('red').html((new Date(parseInt(ZWaveAPIData.updateTime, 10)*1000)).format('HH:MM:ss'));
};

function error_msg(message) {
	$('#server_connection_status').html(message);
};

// Calculates difference between two dates in days
function days_between(date1, date2) {
	return Math.round(Math.abs(date2.getTime() - date1.getTime()) / (1000 * 60 * 60 * 24));
};

// Return string with date in smart format: "hh:mm" if current day, "hh:mm dd" if this week, "hh:mm dd mmmm" if this year, else "hh:mm dd mmmm yyyy"
function getTime(timestamp, invalidReturn) {
	var d = new Date(parseInt(timestamp, 10)*1000);
	if (timestamp === 0 || isNaN(d.getTime()))
		return invalidReturn

	var cd = new Date();

	var fmt;
	if (days_between(cd, d) < 1 && cd.getDate() == d.getDate()) // this day
		fmt = 'HH:MM';
	else if (days_between(cd, d)  < 7 && ((cd < d) ^ (cd.getDay() >= d.getDay()))) // this week
		fmt = 'dddd HH:MM';
	else if (cd.getFullYear() == d.getFullYear()) // this year
		fmt = 'dddd, d mmmm HH:MM';
	else // one upon a time
		fmt = 'dddd, d mmmm yyyy HH:MM';

	return d.format(fmt);
};

// Return span with current date in smart format and class="red" if the data is outdated or class="" if up to date
function getUpdated(data) {
	return '<span class="' + ((data.updateTime > data.invalidateTime) ?'':'red') + '">' + getTime(data.updateTime, '?') + '</span>';
};
