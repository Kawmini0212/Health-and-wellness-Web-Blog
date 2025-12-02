

function calculateBMI(){
    var age = parseFloat(document.getElementById('age').value);
    var height = parseFloat(document.getElementById('height').value);
    var weight = parseFloat(document.getElementById('weight').value);
    var result = "";

    if (isNaN(height) || isNaN(weight)) {
        document.getElementById('bmi-result').innerHTML = "Please enter valid height and weight.";
        return;
    }
    var BMI = weight/ (height * height);
    result = "Your BMI is " + BMI.toFixed(2) + ". ";

    if (age <20) {
        result += "Since you're under 20, consult a doctor or use a BMI percentile chart for your age and gender.";
    } 
    else{
     if (BMI < 18.5) {
        result += "You are underweight.";
    } else if (BMI >= 18.5 && BMI <= 24.9) {
        result += "You have a normal weight.";
    } else if (BMI >= 25 && BMI <= 29.9) {
        result += "You are overweight.";
    } else {
        result += "You are obese.";
    }
}

   document.getElementById('bmi-result').innerHTML = result;
   document.getElementById('result').style.display = "block";




}