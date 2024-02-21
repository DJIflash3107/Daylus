<script>
    function ShowPass() {
        var passInpt = document.getElementById("password");
        var eyePass = document.getElementById("eye-pass");
        passInpt.setAttribute("type", "text");
        passInpt.setAttribute("placeholder", "password");
        eyePass.setAttribute("src", "./assets/icons/eye-slash.svg");
        eyePass.setAttribute("onclick", "HidePass()");
    }
    function HidePass() {
        var passInpt = document.getElementById("password");
        var eyePass = document.getElementById("eye-pass");
        passInpt.setAttribute("type", "password");
        passInpt.setAttribute("placeholder", "••••••••");
        eyePass.setAttribute("src", "./assets/icons/eye.svg");
        eyePass.setAttribute("onclick", "ShowPass()");
    }
</script>