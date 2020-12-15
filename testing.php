<?php
    echo "<td><a href='test.php' onclick='return test_click();'>Location</a></td>";
?>

<script type="text/javascript">
    function test_click(event){
        alert("Inside this function");
        return true;
    }
</script>