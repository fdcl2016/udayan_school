<?php
if(isset($_POST['submit'])) echo $_POST['sohel']."*******";
else echo "gggggggggggg";
?>

<form method="POST" action="">
<input name="hello" type="text">
<img style="margin-left: 5px;width: 35px;height: 35px;margin-bottom: 9px;" type="image"
                                                                     src="../../../public/image/addmore-button-png-hi.png"
                                                                     onclick="academicInformation()"
                                                                     alt="Add Another Class">
                                                                     <div id="academicinformation"></div>
<input type="submit" name="submit">
</form>

<script type="text/javascript">
	var counter = 1;
        function academicInformation() {
            counter++;
            text = "<input placeholder='Degree Name' id='sohel' name='sohel' type='text' class='span2'>";
            var div = document.createElement('div');
            div.innerHTML = text;
            document.getElementById('academicinformation').appendChild(div);
            //alert(text);
        }
            </script>