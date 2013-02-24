<?xml version="1.0" encoding="ISO-8859-1"?>
<xsl:stylesheet xmlns:xsl="http://www.w3.org/1999/XSL/Transform" version="1.0">
<xsl:output method="xml" version="1.0" encoding="iso-8859-1" indent="yes"/>
<xsl:template match="*|text()|@*">
  <xsl:copy>
    <xsl:apply-templates select="*|text()|@*"/>
  </xsl:copy>
</xsl:template>
<xsl:template match="/*">
  <xsl:copy>
     <xsl:apply-templates select="@*"/>
     <xsl:apply-templates select="*[name() = $child]">
       <xsl:sort select="*[name() = $sortby]" data-type="{$type}" order="{$order}" />
     </xsl:apply-templates>
  </xsl:copy>
</xsl:template>
</xsl:stylesheet>
