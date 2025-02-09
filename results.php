<?php include("header.php"); ?>
<!DOCTYPE html>
<html lang="el">
<head>
  <meta charset="UTF-8">
  <meta name="viewport" content="width=device-width, initial-scale=1.0">
  <title>SDG Evaluation - Αποτελέσματα</title>
  <link rel="stylesheet" href="results.css">
  <script src="https://cdn.jsdelivr.net/npm/chart.js"></script>
</head>
<body>
  <main class="container">
    <h1>Αποτελέσματα Αξιολόγησης</h1>
    <div id="scoreDisplay"></div>
    <canvas id="scoreChart"></canvas>
	<div id="wip_list"></div>
    <button onclick="goBack()">Επιστροφή στην Αξιολόγηση</button>
  </main>
  <?php include("footer.php"); ?>
  <script>
    const finalScore = localStorage.getItem("finalScore");
    const indicatorScores = JSON.parse(localStorage.getItem("indicatorScores") || "[]");
	
	const low_indicators = JSON.parse(localStorage.getItem("wip_indicators") || "[]");
	if (low_indicators.length > 0) {
		const wip_list = document.getElementById("wip_list");
		wip_list.innerHTML = `<h3>Τα ακόλουθα indicators χρειάζονται βελτίωση:</h3> <h3 style="color:#ff0000;">${low_indicators.map(item => item.id)}</h3>`;
	}
	
    const scoreDisplay = document.getElementById("scoreDisplay");
    scoreDisplay.innerHTML = finalScore ? `<h2>Τελική Σταθμισμένη Βαθμολογία: ${finalScore}</h2>` : `<p>Δεν βρέθηκαν αποτελέσματα. Παρακαλώ συμπληρώστε την αξιολόγηση.</p>`;
    
	
	
	
	if (indicatorScores.length > 0) {
      const labels = indicatorScores.map(item => item.id);
      const dataValues = indicatorScores.map(item => item.score);
      const ctx = document.getElementById('scoreChart').getContext('2d');
      const scoreChart = new Chart(ctx, {
        type: 'bar',
        data: {
          labels: labels,
          datasets: [{
            label: 'Βαθμολογία ανά Δείκτη',
            data: dataValues,
            backgroundColor: 'rgba(0,82,204,0.6)',
            borderColor: 'rgba(0,82,204,1)',
            borderWidth: 1
          }]
        },
        options: {
          scales: {
            y: {
              beginAtZero: true,
              ticks: { stepSize: 0.5 }
            }
          },
          plugins: {
            legend: { display: false },
            title: {
              display: true,
              text: 'Κατανομή Σταθμισμένων Βαθμολογιών'
            }
          }
        }
      });
    }
    function goBack() {
      window.location.href = "evaluation.php";
    }
  </script>
</body>
</html>
