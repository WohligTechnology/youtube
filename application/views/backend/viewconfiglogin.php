<a onclick="openWin();" class="waves-effect waves-light btn red"><i class="material-icons left">cloud</i>Login with Google</a>

<script>
    var myWindow;

    function openWin() {
        myWindow = window.open("https://accounts.google.com/o/oauth2/auth?client_id=889690190758-3uod1k8ao7ev995ds191jo8uu2supd5a.apps.googleusercontent.com&redirect_uri=http%3A%2F%2Flocalhost%2Fyoutube%2Findex.php%2Fjson%2Fgetyoutubeinfo&scope=https://www.googleapis.com/auth/youtube&response_type=code", "_blank", "width=500, height=500");
    }
</script>