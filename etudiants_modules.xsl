<?xml version="1.0" encoding="UTF-8"?>
<xsl:stylesheet xmlns:xsl="http://www.w3.org/1999/XSL/Transform"
    xmlns:xs="http://www.w3.org/2001/XMLSchema"
    exclude-result-prefixes="xs"
    version="1.0">
    
    <xsl:template match="/">
        <html>
            <body>
                <h2>Etudiants et Modules: <xsl:value-of select="promotion/@niveau"/><xsl:value-of select="promotion/@option"/></h2>
                <i><h1>Liste Etudiants</h1></i>
                <table border="1">
                    <tr bgcolor="#9acd32">
                        <th>numInscription</th>
                        <th>Nom</th>
                        <th>Prenom</th>
                    </tr>
                    <xsl:for-each select="promotion/etudiants/etudiant">
                        <tr>
                            <td><xsl:value-of select="@numInscription"/></td>
                            <td><xsl:value-of select="@nom"/></td>
                            <td><xsl:value-of select="@prenom"/></td>
                        </tr>
                    </xsl:for-each>
                </table><br></br><br></br><br></br><br></br>                
                <i><h1>Liste Modules</h1></i>
                <table border="1">
                    <tr bgcolor="#9acd32">
                        <th>idModule</th>
                        <th>nomModule</th>
                    </tr>
                    <xsl:for-each select="promotion/modules/module">
                        <tr>
                            <td><xsl:value-of select="@idModule"/></td>
                            <td><xsl:value-of select="@nomModule"/></td>
                        </tr>
                    </xsl:for-each>
                </table> 
            </body>
        </html>
    </xsl:template>
    
</xsl:stylesheet>