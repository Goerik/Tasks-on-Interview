<%@ Page Title="Home Page" Language="C#" MasterPageFile="~/Site.master" AutoEventWireup="true"
    CodeBehind="Default.aspx.cs" Inherits="TestWeb._Default" %>

<asp:Content ID="HeaderContent" runat="server" ContentPlaceHolderID="HeadContent">
    <script src="http://ajax.googleapis.com/ajax/libs/jquery/1.9.1/jquery.min.js" type="text/javascript"></script>
</asp:Content>
<asp:Content ID="BodyContent" runat="server" ContentPlaceHolderID="MainContent">
    <h2>Test form</h2>
	<form action="Default.aspx">
		<table>
			<tr>
				<td><label for="name">Your name:</label></td>
				<td><input type="text" id="name" name="name"/></td>
			</tr>
			<tr>
				<td><label for="color">Your favourite color:</label></td>
				<td>
					<select id="color" name="color">
						<option>Green</option>
						<option>Red</option>
						<option>Yellow</option>
					</select>
				</td>
			</tr>
			<tr>
				<td><label for="v18years">You are older than 18 years</label></td>
				<td><input type="checkbox" id="v18years" name="v18years"/></td>
			</tr>
			<tr>
				<td>Your favourite time of day:</td>
				<td>
					<input type="radio" id="radio-morning" name="favTime" /><label for="radio-morning">Morning</label><br />
					<input type="radio" id="radio-evening" name="favTime" /><label for="radio-evening">Evening</label><br />
					<input type="radio" id="radio-night" name="favTime" /><label for="radio-night">Night</label><br />
				</td>
			</tr>
			<tr>
				<td colspan="2">  <input type="button" id="btnSubmitJSON" name="btnSubmitJSON" value="Submit" />
                    
                    
                  

				</td>
			</tr>
		</table>
		
        <div id="hidden" style="display: none" >
            <h2>You data</h2>
            <table>
			<tr>
				<td>Your name:</td>
				<td><input type="text" id="rname" name="rname"/></td>
			</tr>
			<tr>
				<td>Your favourite color:</td>
				<td>
					<input type="text" id="rcolor" name="rcolor"/>
				</td>
			</tr>
			<tr>
				<td>You are older than 18 years</td>
				<td><input type="text" id="ryears" name="ryears"/></td>
			</tr>
			<tr>
				<td>Your favourite time of day:</td>
				<td>
					<input type="text" id="rfavtime" name="rfavtime"/>
				</td>
			</tr>
			<tr>
				<td colspan="2">  <input type="button" id="Button1" name="btnSubmitJSON" value="Submit" />
                    
                    
                  

				</td>
			</tr>
		</table>

        </div>

	</form>
    
            <script type="text/javascript">

                $(function () {

                    $("#btnSubmitJSON").click(function () {
                        
                        var nameValue = $("#name").val();
                        var colorValue = $("#color").val();
                        var yearsValue = $("#v18years").prop('checked');
                        var favtimeValue = "";
                        
                        if ($("#radio-morning").prop('checked')) {
                            favtimeValue = "Morning";
                        }
                        
                        if ($("#radio-evening").prop('checked')) {
                            favtimeValue = "Evening";                     
                        }
                        
                        if ($("#radio-night").prop('checked')) {
                            favtimeValue = "Night";
                        }
                     
                        var jsonData = {
                            'Name': nameValue,
                            'Color': colorValue,
                            'Years': yearsValue,
                            'FavTime': favtimeValue
                        };

                        
                        jsonData = JSON.stringify(jsonData);

                        $.ajax({
                            url: "/Parse.ashx", 
                            cache: false,
                            type: 'POST',
                            data: jsonData,
                            success: function (response) {
                              
                                $("#rname").val(response.Name);
                                $("#rcolor").val(response.Color);
                                $("#ryears").val(response.Years);
                                $("#rfavtime").val(response.FavTime);
                                $("#hidden").show();

                            },
                            error: function (xhr, ajaxOptions, thrownError) {

                                alert("Not all field filled!");
                                $("#hidden").hide();
                            }
                        });
                    });
                });
        </script>

</asp:Content>
