function createPieChart(question_id, chart_id, data) {
  const chartData = {
    labels: data.map((item) => item.label),
    datasets: [
      {
        data: data.map((item) => item.value),
        backgroundColor: [
          "#36A2EB",
          "#FF6384",
          "#FFCE56",
          "#FF8A56",
          "#36B2EB",
          "#FF6A84",
          "#FF5E56",
        ],
        borderWidth: 1, // Add border to the pie chart segments
      },
    ],
  };

  const ctx = document.getElementById(chart_id).getContext("2d");
  new Chart(ctx, {
    type: "pie",
    data: chartData,
    options: {
      plugins: {
        legend: {
          display: false, // Hide the legend
        },
        datalabels: {
          color: "#fff", // Label text color
          font: {
            size: 10, // Label font size
          },
          formatter: (value, ctx) => {
            let label = ctx.chart.data.labels[ctx.dataIndex];
            return (
              label +
              ": " +
              value +
              " (" +
              (
                (value * 100) /
                ctx.chart.data.datasets[0].data.reduce((a, b) => a + b, 0)
              ).toFixed(1) +
              "%)"
            );
          },
          anchor: "center", // Position the labels at the center of the segments
          align: "center", // Align the labels with the center of the segments
        },
      },
    },
  });
}

document.addEventListener("DOMContentLoaded", function () {
  const displayedCharts = [2, 3, 5, 6, 7, 8, 9];

  displayedCharts.forEach(function (question_id) {
    const data = JSON.parse(
      document.getElementById(`data_${question_id}`).textContent
    );
    const chart_id = `chart_${question_id}`;
    createPieChart(question_id, chart_id, data);
  });
});

document.addEventListener("DOMContentLoaded", function () {
  const questionTypeSelects = document.querySelectorAll(
    '[id^="question_type_"]'
  );

  questionTypeSelects.forEach((select) => {
    const optionsInput = document.getElementById(
      "question_options_" + select.id.split("_")[2]
    );

    toggleOptionsInput(optionsInput, select.value);

    select.addEventListener("change", function () {
      toggleOptionsInput(optionsInput, this.value);
    });
  });

  function toggleOptionsInput(input, selectedValue) {
    if (selectedValue === "select" || selectedValue === "radio") {
      input.style.display = "block";
    } else {
      input.style.display = "none";
    }
  }
});

function showOptionsField(selectElement) {
  const questionId = selectElement.id.split("_")[2];
  const optionsField = document.getElementById(`options_field_${questionId}`);

  if (selectElement.value === "select" || selectElement.value === "radio") {
    optionsField.style.display = "block";
  } else {
    optionsField.style.display = "none";
  }
}

function showTextArea(selectElement, textareaId) {
  var selectedOption = selectElement.options[selectElement.selectedIndex].value;
  var textareaDiv = document.getElementById(textareaId);

  if (selectedOption === "Other") {
    textareaDiv.style.display = "block";
  } else {
    textareaDiv.style.display = "none";
  }
}
