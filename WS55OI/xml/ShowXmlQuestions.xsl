<?xml version="1.0"?>
<xsl:stylesheet version="1.0"
xmlns:xsl="http://www.w3.org/1999/XSL/Transform">
<xsl:template match="/">
	<html><body>
		<table border="2">
		<thead><tr><th>Egilea</th><th>Gaia</th><th>Galdera</th><th>Erantzuna</th><th>Okerrak</th></tr></thead>
		<xsl:for-each select="/assessmentItems/assessmentItem" >
			<tr>
			<td>
			<xsl:value-of select="@author"/> <br/>
			</td>
			<td>
			<xsl:value-of select="@subject"/> <br/>
			</td>
			<td>
			<xsl:value-of select="itemBody/p"/> <br/>
			</td>
			<td>
			<xsl:value-of select="correctResponse/response"/> <br/>
			</td>
			<td>
				<xsl:for-each select="incorrectResponses/response" >
					<xsl:value-of select="."/> <br/>
				</xsl:for-each>
			</td>
			</tr>
		</xsl:for-each>
		</table>
	</body></html>
</xsl:template>
</xsl:stylesheet>