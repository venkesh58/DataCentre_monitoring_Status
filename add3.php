<!DOCTYPE html>
<html>
    <body bgcolor="#666699">
           
        <div id="container" style="width:1250px">
                
            <div id="header" style="background-color:#FF6666;height:40px; " >
                
                    <font face="Arial" size="6">
                        <center>
                            Data monitoring Status
                        </center>
                    </font>
                    
            </div>
                
            <div id="tab" style="background-color:#CCCCCC;height:80px;width:1250px;float:left;">
                <center>
                    <font face="arial" size="5">
                        <br>
                        Devices Page
                    </font>
                </center>    
            </div>
            
      <div id="menu" style="background-color:#FFFF66;height:550px;width:200px;float:left;">   
                
                    <font face="arial" size="5">
                        <br><br><br>
                        &nbsp;&nbsp;&nbsp;<a href="index.php">Home</a><br><br>
                        &nbsp;&nbsp;&nbsp;<a href="add3.php">Add a Device</a><br><br>
                        &nbsp;&nbsp;&nbsp;<a href="delete3.php">Delete a Device</a><br><br>
                        &nbsp;&nbsp;&nbsp;<a href="display3.php">Display Devices</a><br><br>                        
                    </font>    
                    
            </div>
                
            

           <div id="content" style="background-color:#EEEEEE;height:550px;width:1050px;float:left;">
                <center> 
                    <form action="add3connect.php" method="POST">
                        <table border=1 width="700" align="center" cellpadding="10">
                            <br><br><br>
                            <br><br>    
                            <tr>
                            <td COLSPAN=2 STYLE="COLOR:BLACK;background-color:#FFCC99" align="center">DEVICE SPECIFICATIONS
                            </td>
                            </tr>
                                <TR><TD  STYLE="COLOR:BLACK;background-color:#FFFFCC">&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;IP</TD><TD STYLE="COLOR:BLACK;background-color:#FFFFCC" align="center"><input type="tinytext" name="IP" aria-describedby="number-format" required aria-required="true"></TD></TR>
                                <TR><TD  STYLE="COLOR:BLACK;background-color:#FFFFCC">&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;PORT</TD><TD align="center" STYLE="COLOR:BLACK;background-color:#FFFFCC"><input type="number" name="PORT" ></TD></TR>
                                <TR><TD  STYLE="COLOR:BLACK;background-color:#FFFFCC">&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;COMMUNITY</TD><TD align="center" STYLE="COLOR:BLACK;background-color:#FFFFCC"><input type="text" name="COMMUNITY" aria-describedby="name-format" required aria-required="true"></TD></TR>
                                </TD></TR>
                                <TR><TD colspan=2 align="center" STYLE="COLOR:BLACK;background-color:#FFFFCC"><input type="submit" name="formsubmit" value="ADD"></TD></TR>
                        </table>
                    </center>  
            </div>    
                
            <div id="footer" style="background-color:#FF6666;clear:both;text-align:center;">
                vekb15@student.bth.se
            </div>
        </div>
    </body>
</html>
