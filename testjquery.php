<?php ?>
<!DOCTYPE html>
<html>
    <head>
        <script src="//code.jquery.com/jquery-1.11.3.min.js"></script>
        <style>
            .red {
                background-color: red;
            }
            .green {
                background-color: green;
            }
        </style>
        <script>
            $(function () {
                $("button").click(function ()
                {
                    $("button").html("hello")
                            .addClass("red");
                })
                var names = ["john", "sally", "bill"];
                $("body").append(
                        names.map(function (n) {
                        return $("<p/>").text(n);
                });
            });

        </script>
    </head>
    <body>
    </<body>
        <button onclick="">test</button>
    </body>
</html>

