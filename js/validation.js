const validation = new Justvalidate("#validate");

validation.addField("name", [
  {
    rule: "required",
    message: "Please enter your full name",
  },
]);
