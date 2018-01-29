<html>
    <head>
        <title>Post</title>
        <meta http-equiv="Content-Type" content="text/html; charset=utf-8"/>
        <script type="text/javascript" src="js/jquery-1.3.2.js"></script>
        <script type="text/javascript" src="js/jquery.validate.js"></script>
        <script type="text/javascript" src="js/jquery.form.js"></script>
        <script type="text/javascript" src="js/tinymce/jscripts/tiny_mce/jquery.tinymce.js"></script>
        <script type="text/javascript" src="js/tinyrte.js"></script>
        <script type="text/javascript">

            $(document).ready(function(){
                $.validator.setDefaults({
                    submitHandler: function() {

                        $('#postadd').bind('form-pre-serialize', function(e) {
                            tinyMCE.triggerSave();
                        });

                        $('#postadd').ajaxSubmit(function(result) {
                            $("#message").show().html(result).fadeOut(5000);
                            window.location.replace("index.php);
                        });
                    }
                });
                // validate the form on keyup and submit
                $("#postadd").validate({
                    rules: {
                        title: "required",
                        long_description: "required"
                    },
                    messages: {
                        title: "&nbsp;Please fill the field",
                        long_description: "&nbsp;Please fill the field"
                    }
                });
            });

        </script>
    </head>
    <body>

        <form name="postadd" id="postadd" method="POST" action="ajax.inc.php">
            <div>
                <table>
                    <tr>
                        <td>Title *</td>
                    </tr>
                    <tr>
                        <td><input type="text" name="title"  id="title" value="" size="114" /></td>
                    </tr>
                    <tr>
                        <td>&nbsp;</td>
                    </tr>
                    <tr>
                        <td>Short Description</td>
                    </tr>
                    <tr>
                        <td><textarea name="short_description" id="short_description" style="width:97%" rows="6" cols="90" ></textarea></td>
                    </tr>
                    <tr>
                        <td>&nbsp;</td>
                    </tr>
                    <tr>
                        <td>Long Description</td>
                    </tr>
                    <tr>
                        <td><textarea name="long_description" id="long_description" rows="12" cols="80" style="width:97%" class="tinymce"></textarea></td>
                    </tr>
                    <tr>
                        <td>&nbsp;</td>
                    </tr>                    
                    <tr>
                        <td><input name="_task" id="_task" type="hidden" value="add" />
                            <input type="submit" value="Save" name="btnsave" id="btnsave" />
                        &nbsp;&nbsp;&nbsp;&nbsp;<input type="submit" value="Cancel" name="btncancel" id="btncancel" /></td>
                    </tr>

                </table>
            </div>

        </form>

    </body>
</html>