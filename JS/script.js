function showMessage() {
alert("مرحباً بكم في وكالة ركن الأجور للسفر والسياحة! ❤️");
}

function showServices() {
alert(
"خدماتنا:\n" +
"1- الحج والعمرة\n" +
"2- السفر الجوي\n" +
"3- السفر البري\n" +
"4- الإقامات والزيارات\n" +
"5- الموافقات الأمنية"
);
}

function changeBackground() {
document.body.style.backgroundColor = "lightpink";
}

function showDate() {
let today = new Date();
alert("تاريخ اليوم: " + today.toLocaleDateString());
}

function loginMessage() {
let username = document.getElementById("username").value.trim();
let password = document.getElementById("password").value;

if (username === "" || password === "") {
    alert("من فضلك أدخل اسم المستخدم وكلمة المرور ❤️");
} else {
    alert("مرحباً " + username + " ❤️");
}
  }
