<!DOCTYPE html>
<html>
    <head>
<script src="http://ajax.googleapis.com/ajax/libs/jquery/1.11.2/jquery.min.js"></script>
<script>
function hideStudentChildren(){
if ($("#SNMP").is(":checked")) {
    $("#BYTES").removeAttr("disabled");
    $("#REQUESTS").removeAttr("disabled");
    $("#CPU").removeAttr("disabled");
    $("#SNMPPORT").removeAttr("disabled");
    $("#BYTESREQUESTS").removeAttr("disabled");
    $("#HTTPPORT").attr("disabled","disabled");
}
if ($("#HTTP").is(":checked")) {
    $("#BYTES").attr("disabled","disabled");
    $("#REQUESTS").attr("disabled","disabled");
    $("#CPU").attr("disabled","disabled");
    $("#SNMPPORT").attr("disabled","disabled");
    $("#BYTESREQUESTS").attr("disabled","disabled");
    $("#HTTPPORT").removeAttr("disabled");
}

}
</script>
</head>
     <body bgcolor="#666699">
	      <table style="width:1250px;" cellpadding="0" cellspacing="0">
		     <tr>
			    <td colspan="2" style="background-color:#FF6666;height:40px;">
	      			    <font face="Arial" size="6">
					  <center>
						 Data monitoring Status
					  </center>
				    </font>
			    </td>
		     </tr>
		     <tr>
			    <td colspan="2" style="background-color:#CCCCCC;height:80px;width:1250px;">
				  <center>
					 <font face="arial" size="5">
						       Servers - Addition of a New Server
					 </font>
				   </center>    
			    </td>
		     </tr>
		     	   
		     <tr>
			    <td style="background-color:#FFFF66;width:200px;vertical-align:top;">
				   <div id="nav">
				   
					  <font face="arial" size="5">
					  	  <br><br><br>
					  	   &nbsp;&nbsp;&nbsp;<a href="index.php">Home</a><br><br>
						   &nbsp;&nbsp;&nbsp;<a href="add3_server.php">Add a Server</a><br><br>
						   &nbsp;&nbsp;&nbsp;<a href="delete3_server.php">Delete a Server</a><br><br>
						   &nbsp;&nbsp;&nbsp;<a href="display3_server.php">Display Metrics</a><br><br> 
					  </font>	
				   </div>
			    </td>
			    <td style="background-color:#EEEEEE;height:550px;width:1050px;;vertical-align:top;">
				   <center>
                    
                    <form action="add3connect_server.php" method="POST">
                        <table border=1 width="700" align="center" cellpadding="10">
                            <br><br>
                               
                            <tr>
                            <td COLSPAN=2 STYLE="COLOR:BLACK;background-color:#FFCC99" align="center">SERVER SPECIFICATIONS
                            </td>
                            </tr>
                                <TR>
                                    <TD  STYLE="COLOR:BLACK;background-color:#FFFFCC">&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;NAME
                                    </TD>
                                    <TD STYLE="COLOR:BLACK;background-color:#FFFFCC" align="center">
                                        <input type="text" name="NAME" aria-describedby="number-format" required aria-required="true">
                                    </TD>
                                </TR>
                                <TR>
                                    <TD  STYLE="COLOR:BLACK;background-color:#FFFFCC">&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;IP</TD>
                                    <TD STYLE="COLOR:BLACK;background-color:#FFFFCC" align="center">
                                        <input type="tinytext" name="IP" aria-describedby="number-format" required aria-required="true">
                                    </TD>
                                </TR>
                                <TR>
                                    <TD  STYLE="COLOR:BLACK;background-color:#FFFFCC">&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;COMMUNITY
                                    </TD>
                                    <TD align="center" STYLE="COLOR:BLACK;background-color:#FFFFCC">
                                        <input type="text" name="COMMUNITY" aria-describedby="name-format" required aria-required="true">
                                    </TD>
                                </TR>
                                <TR><TD  STYLE="COLOR:BLACK;background-color:#FFFFCC">&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;HTTPPORT</TD><TD align="center" STYLE="COLOR:BLACK;background-color:#FFFFCC"><input type="number" name="PORT" ></TD></TR>
                                <TR><TD colspan=2 align="center" STYLE="COLOR:BLACK;background-color:#FFFFCC">
                                <input type="submit" name="formsubmit" value="ADD">
                                </TD>
                                </TR>
                        </table>
                    
                    
          

          
                    
                    <br>
				   </center>
			    </td>
			    </tr>
		     <tr>
			    <td colspan="2" style="background-color:#FF6666;text-align:center;">
				   vekb15@student.bth.se
			    </td>
		     </tr>
	      </table>
       </body>
</html>

