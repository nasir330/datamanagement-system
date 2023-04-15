window.onload = function() {

	var options = {
		backgroundColor: "transparent",
		exportEnabled: false,
		animationEnabled: true,	
		legend:{
			horizontalAlign: "center",
			verticalAlign: "bottom"
		},
		data: [{
			type: "doughnut",
			radius: "98%", 
			innerRadius: "20%",        
			showInLegend: true,
			toolTipContent: "<b>{name}</b>: {y} (#percent%)",
			indexLabel: "{name}",
			legendText: "{name} (#percent%)",
			indexLabelPlacement: "inside",
			dataPoints: [
				{ y: 488, name: "user1" },
				{ y: 300, name: "user2" },
				{ y: 450, name: "user3" },
				{ y: 480, name: "user4" }
			]
		}]
	};
	$("#pieChart").CanvasJSChart(options);
	
	}
	