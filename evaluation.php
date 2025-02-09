<?php include("header.php"); ?>
<!DOCTYPE html>
<html lang="el">
<head>
  <meta charset="UTF-8">
  <meta name="viewport" content="width=device-width, initial-scale=1.0">
  <title>SDG Evaluation - Εισαγωγή Δεδομένων Αξιολόγησης</title>
  <link rel="stylesheet" href="evaluation.css">
</head>
<body>
  <main class="container">
    <h1>Εισαγωγή Δεδομένων Αξιολόγησης</h1>
    <p>Συμπληρώστε τις βαθμολογίες για κάθε δείκτη σύμφωνα με τους SDGs.</p>
    <form id="evaluationForm">
      <table id="indicatorsTable">
        <thead>
          <tr>
            <th>Δείκτης</th>
            <th>Βαθμολογία / Εισαγωγή</th>
            <th>Βάρος (w<sub>i</sub>)</th>
          </tr>
        </thead>
        <tbody></tbody>
      </table>
      <button type="button" onclick="calculateEvaluation()">Υπολογισμός Αξιολόγησης</button>
    </form>
  </main>
  <?php include("footer.php"); ?>
  <script>
    const indicators = [
      { id: "I1",  weight: 0.784, thresholdGroup: "group1", type: "normal"  , eval: "v1"},
      { id: "I2",  weight: 2.25,  thresholdGroup: "group1", type: "normal"  , eval: "v1"},
      { id: "I3",  weight: 0.58,  type: "division", divCondition: "greater" , eval: "null"},
      { id: "I4",  weight: 1.26,  thresholdGroup: "group1", type: "normal"  , eval: "v1"},
      { id: "I5",  weight: 0.663, thresholdGroup: "group1", type: "normal"  , eval: "v1"},
      { id: "I6",  weight: 0.337, thresholdGroup: "group1", type: "normal"  , eval: "v1"},
      { id: "I7",  weight: 0.701, thresholdGroup: "group1", type: "normal"  , eval: "v1"},
      { id: "I8",  weight: 0.299, type: "division", divCondition: "less"    , eval: "null"},
      { id: "I9",  weight: 0.193, type: "division", divCondition: "less"    , eval: "null"},
      { id: "I10", weight: 0.257, thresholdGroup: "group2", type: "normal"  , eval: "v2"},
      { id: "I11", weight: 0.663, thresholdGroup: "group2", type: "normal"  , eval: "v2"},
      { id: "I12", weight: 0.123, thresholdGroup: "group2", type: "normal"  , eval: "v2"},
      { id: "I13", weight: 0.552, type: "division", divCondition: "greater" , eval: "null"},
      { id: "I14", weight: 0.448, thresholdGroup: "group2", type: "normal"  , eval: "v2"},
      { id: "I15", weight: 0.58,  thresholdGroup: "group2", type: "normal"  , eval: "v2"},
      { id: "I16", weight: 0.264, thresholdGroup: "group2", type: "normal"  , eval: "v2"},
      { id: "I17", weight: 0.176, type: "division", divCondition: "greater" , eval: "null"},
      { id: "I18", weight: 1,     type: "division", divCondition: "less"    , eval: "null"},
      { id: "I19", weight: 1,     thresholdGroup: "group2", type: "normal"  , eval: "v2"},
      { id: "I20", weight: 0,     thresholdGroup: "group1", type: "normal"  , eval: "v1"},
      { id: "I21", weight: 2,     thresholdGroup: "group2", type: "normal"  , eval: "v2"},
      { id: "I22", weight: 3,     thresholdGroup: "group2", type: "normal"  , eval: "v2"},
      { id: "I23", weight: 0.422, thresholdGroup: "group2", type: "normal"  , eval: "v2"},
      { id: "I24", weight: 0.266, type: "division", divCondition: "greater" , eval: "null"},
      { id: "I25", weight: 0.589, thresholdGroup: "group1", type: "normal"  , eval: "v1"},
      { id: "I26", weight: 0.411, thresholdGroup: "group2", type: "normal"  , eval: "v2"},
      { id: "I27", weight: 3,     thresholdGroup: "group2", type: "normal"  , eval: "v2"},
      { id: "I28", weight: 1,     thresholdGroup: "group2", type: "normal"  , eval: "v2"},
      { id: "I29", weight: 1,     thresholdGroup: "group2", type: "normal"  , eval: "v2"},
      { id: "I30", weight: 0.241, type: "division", divCondition: "less"    , eval: "null"},
      { id: "I31", weight: 0.322, thresholdGroup: "group1", type: "normal"  , eval: "v1"},
      { id: "I32", weight: 0.18,  thresholdGroup: "group1", type: "normal"  , eval: "v1"},
      { id: "I33", weight: 0.114, thresholdGroup: "group2", type: "normal"  , eval: "v2"},
      { id: "I34", weight: 0.143, thresholdGroup: "group2", type: "normal"  , eval: "v2"}
    ];
	
    function createTable() {
      const tbody = document.querySelector('#indicatorsTable tbody');
      indicators.forEach(indicator => {
        const tr = document.createElement('tr');
        const tdId = document.createElement('td');
        tdId.textContent = indicator.id;
        tr.appendChild(tdId);
        const tdInput = document.createElement('td');
        if (indicator.type === 'normal') {
          let opts1, opts2, opts3;
          if (indicator.thresholdGroup === "group1") {
            opts1 = ["0", "0.25", "1"];
            opts2 = ["0", "1"];
            opts3 = ["0", "1"];
          } else {
            opts1 = ["0", "1"];
            opts2 = ["0", "1"];
            opts3 = ["0", "1"];
          }
          const select1 = document.createElement('select');
          select1.id = indicator.id + '_score_1';
          select1.required = true;
          opts1.forEach(val => {
            const opt = document.createElement('option');
            opt.value = val;
            opt.textContent = val;
            select1.appendChild(opt);
          });
          tdInput.appendChild(select1);
          tdInput.appendChild(document.createTextNode(" "));
          const select2 = document.createElement('select');
          select2.id = indicator.id + '_score_2';
          select2.required = true;
          opts2.forEach(val => {
            const opt = document.createElement('option');
            opt.value = val;
            opt.textContent = val;
            select2.appendChild(opt);
          });
          tdInput.appendChild(select2);
          tdInput.appendChild(document.createTextNode(" "));
          const select3 = document.createElement('select');
          select3.id = indicator.id + '_score_3';
          select3.required = true;
          opts3.forEach(val => {
            const opt = document.createElement('option');
            opt.value = val;
            opt.textContent = val;
            select3.appendChild(opt);
          });
          tdInput.appendChild(select3);
        } else if (indicator.type === 'division') {
		  const text1 = document.createElement('label');
		  text1.textContent = "Έτος Αναφοράς";
		  tdInput.appendChild(text1);
		  
		  tdInput.appendChild(document.createElement('br'));
		  
          const inputRef = document.createElement('input');
          inputRef.type = 'number';
          inputRef.step = 'any';
          inputRef.id = indicator.id + '_ref_value';
          inputRef.placeholder = 'X1A';
          inputRef.required = true;
          tdInput.appendChild(inputRef);
		  
		  const inputEval = document.createElement('input');
          inputEval.type = 'number';
          inputEval.step = 'any';
          inputEval.id = indicator.id + '_eval_value';
          inputEval.placeholder = 'X1B';
          inputEval.required = true;
          tdInput.appendChild(inputEval);
		  
          tdInput.appendChild(document.createElement('br'));
		  
		  const text2 = document.createElement('label');
		  text2.textContent = "Έτος Αξιολόγησης";
		  tdInput.appendChild(text2);
		  
		  tdInput.appendChild(document.createElement('br'));
		  
		  const inputRef2 = document.createElement('input');
          inputRef2.type = 'number';
          inputRef2.step = 'any';
          inputRef2.id = indicator.id + '_ref_value2';
          inputRef2.placeholder = 'X2A';
          inputRef2.required = true;
          tdInput.appendChild(inputRef2);
          
		  const inputEval2 = document.createElement('input');
          inputEval2.type = 'number';
          inputEval2.step = 'any';
          inputEval2.id = indicator.id + '_eval_value2';
          inputEval2.placeholder = 'X2B';
          inputEval2.required = true;
          tdInput.appendChild(inputEval2);
		  
        }
        tr.appendChild(tdInput);
        const tdWeight = document.createElement('td');
        tdWeight.textContent = indicator.weight;
        tr.appendChild(tdWeight);
        tbody.appendChild(tr);
      });
    }
    function calculateEvaluation() {
      let totalWeightedScore = 0;
      let indicatorScores = [];
	  let wip_indicators = [];
      indicators.forEach(indicator => {
        let score = 0, weightedValue = 0;
        if (indicator.type === 'normal') {
          const s1 = parseFloat(document.getElementById(indicator.id + '_score_1').value) || 0;
          const s2 = parseFloat(document.getElementById(indicator.id + '_score_2').value) || 0;
          const s3 = parseFloat(document.getElementById(indicator.id + '_score_3').value) || 0;
          score = s1 + s2 + s3;
          weightedValue = score * indicator.weight;
        } else if (indicator.type === 'division') {
          const refVal = parseFloat(document.getElementById(indicator.id + '_ref_value').value) || 0;
          const evalVal = parseFloat(document.getElementById(indicator.id + '_eval_value').value) || 0;
		  const refVal2 = parseFloat(document.getElementById(indicator.id + '_ref_value2').value) || 0;
          const evalVal2 = parseFloat(document.getElementById(indicator.id + '_eval_value2').value) || 0;
          let percentChange = 0;
		  let refTotal = 0;
		  let evalTotal = 0;
		  
		  if (refVal2 !== 0) {
			refTotal = (refVal / refVal2);
		  }
		  if (evalVal2 !== 0) {
			evalTotal = (evalVal / evalVal2);
		  }
		  
          if (refTotal !== 0) {
            percentChange = (evalTotal - refTotal) / refTotal;
          }
          if (indicator.divCondition === "greater") {
            score = (refTotal === 0 || percentChange > 1 || percentChange === 0) ? 0 : 1 / percentChange;
          } else if (indicator.divCondition === "less") {
            score = (refTotal === 0 || percentChange < 1) ? 0 : evalTotal;
          }
          weightedValue = score * indicator.weight;
        }
		
		if((weightedValue < 2.25) && (indicator.eval === "v1"))
		  {
			  //MORE THINGS CAN BE DONE
			  wip_indicators.push({ id: indicator.id});
		  }
		  if((weightedValue < 2) && (indicator.eval === "v2"))
		  {
			  //MORE THINGS CAN BE DONE
			  wip_indicators.push({ id: indicator.id});
		  }
		
        totalWeightedScore += weightedValue;
        indicatorScores.push({ id: indicator.id, score: weightedValue });
      });
      localStorage.setItem("finalScore", totalWeightedScore.toFixed(3));
      localStorage.setItem("indicatorScores", JSON.stringify(indicatorScores));
	  
	  console.log(JSON.stringify(wip_indicators)); //debug

      window.location.href = "results.php";
    }
    window.onload = createTable;
  </script>
</body>
</html>
