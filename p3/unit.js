var report = function (feet, miles) {
    document.getElementById("result").innerHTML =
        parseFloat(feet).toFixed(2) + "ft = " + parseFloat(miles).toFixed(2) + "m";
};

document.getElementById("f_to_m").onclick = function () {
    var f = document.getElementById("unit").value;
    report(f, f_to_m(f));
};

document.getElementById("m_to_f").onclick = function () {
    var c = document.getElementById("unit").value;
    report(c, m_to_f(c));
};

// checks to see if a postive number was entered then converts from feet to miles
function f_to_m (feetcon){
    if(feetcon > 0)
        {
            return (feetcon/5280);
        }
    else
        {
            alert("please enter a positive number");
        }
}

// checks to see if a postive number was entered then converts from miles to feet
function m_to_f (milecon){
    if(milecon > 0)
        {
            return (milecon * 5280);
        }
    else
        {
        alert("please enter a positive number");
        }
}