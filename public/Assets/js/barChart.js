window.onload = function () {
    myBarchart();
    function myBarchart() {
        var chart = new CanvasJS.Chart("barChart", {
            backgroundColor: "transparent",
            animationEnabled: true,
            theme: "dark2", // "light1", "light2", "dark1", "dark2"

            data: [{
                type: "column",
                showInLegend: true,
                legendMarkerColor: "grey",
                //legendText: "MMbbl = one million barrels",
                dataPoints: [
                    { y: 488, name: "user1" },
                    { y: 480, name: "user2" },
                    { y: 450, name: "user3" },
                    { y: 480, name: "user4" }

                ]
            }]
        });
        chart.render();
    }


}