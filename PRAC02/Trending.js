//    <!-- ...............The flip cards code........................................... -->

//    <script>
function loadDoc() {

    var xhttp = new XMLHttpRequest();
    xhttp.onreadystatechange = function () {
        if (this.readyState == 4 && this.status == 200) {
            var d = this.responseText;
            var myObj = JSON.parse(this.responseText);

            for (var i = 0; i < 10; i++) {
                var a = myObj.data[i]["cover_xl"];
                var b = myObj.data[i]["title"];
                var c = myObj.data[i]["artist"]["name"];
                var e = myObj.data[i]["position"];
                var g = myObj.data[i]["link"];
                var h = myObj.data[i]["record_type"];
                var m = myObj.data[i]["tracklist"];


                console.log(b);
                // document.getElementById("memo").src  = picture;

                var z = document.getElementsByClassName("a");
                z[i].src = a;

                var y = document.getElementsByClassName("b");
                y[i].innerHTML = b;

                var x = document.getElementsByClassName("c");
                x[i].innerHTML = c;

                var x = document.getElementsByClassName("g");
                x[i].innerHTML = g;

                var x = document.getElementsByClassName("e");
                x[i].innerHTML = e;

                var x = document.getElementsByClassName("f");
                x[i].innerHTML = h;

                var x = document.getElementsByClassName("h");
                x[i].innerHTML = m;

            }
        }

    };
    xhttp.open("get", "https://cors-anywhere.herokuapp.com/https://api.deezer.com/chart/0/albums", true);
    xhttp.send();
}

//    </script>
//    <!-- ...............The flip cards code........................................... -->


//    <!-- ................The search,.................................................. -->

//    <script>
$(document).ready(function () {
    function search() {
        var input, filter, ul, li, a, i, txtVal;
        input = document.getElementById('searchTerm');
        console.log("input: " + input);
        filter = input.value.toUpperCase();
        console.log("Filter: " + filter);
        sections = document.getElementsByClassName("flip-card");
        for (i = 0; i < sections.length; i++) {
            a = sections[i].getElementsByTagName("h1")[0];
            txtVal = a.textContent;
            if (txtVal.toUpperCase().indexOf(filter) > -1) {
                sections[i].style.display = "";
            } else {
                sections[i].style.display = "none";
            }
        }
    }
})();


//    </script>

//    <!-- ................The search,.................................................. -->
//</head>
