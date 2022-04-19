<?xml version = "1.0" encoding = "UTF-8"?> 
   <xsl:stylesheet version = "1.0" 
      xmlns:xsl = "http://www.w3.org/1999/XSL/Transform">
   <xsl:template match = "/"> 
      <html> 
         <body> 
            <h2>Students</h2> 
            <table border = "1"> 
               <tr bgcolor = "#9acd32"> 
                  <th>jour</th> 
                  <th>heure_debut</th> 
                  <th>heure_fin</th> 
                  <th>enseignant</th> 
                  <th>modul</th>
                  <th>lien</th> 
               </tr> 
					
               <xsl:for-each select = "emploi/seance"> 
					
                  <tr> 
                     <td><xsl:value-of select = "@jour"/></td> 
                     <td><xsl:value-of select = "@heure_debut"/></td> 
                     <td><xsl:value-of select = "@heure_fin"/></td> 
                     <td><xsl:value-of select = "@enseignant"/></td> 
                     <td><xsl:value-of select = "@modul"/></td> 
                     <td><xsl:value-of select = "@salle"/></td> 
                     
                  </tr> 
               </xsl:for-each> 
					
            </table> 
         </body> 
      </html> 
   </xsl:template>  
</xsl:stylesheet>