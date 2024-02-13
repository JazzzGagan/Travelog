/* const validate = new JustValidate("#formregister", {
  submitFormAutomatically: true,
});

validate
  .addField("#username", [
    {
      rule: "required",
    },
  ])
  .addField("#email", [
    {
      rule: "required",
    },
    {
      rule: "email",
    },
    {
      validator: (value) => () => {
        return fetch("validate-email.php?email=" + encodeURIComponent(value))
          .then(function (response) {
            return response.json();
          })
          .then(function (json) {
            return json.available;
          });
      },
      errorMessage: "email already taken",
    },
  ])
  .addField("#password", [
    {
      rule: "required",
    },
    {
      rule: "password",
    },
  ]);
 */

const validation = new JustValidate("#formregister");

validation
  .addField("#username", [
    {
      rule: "required",
      errorMessage: "username is required",
    },
  ])
  .addField("#email", [
    {
      rule: "required",
      errorMessage: "email is required",
    },
    {
      rule: "email",
    },
    {
      validator: (value) => () => {
        return fetch("validate-email.php?email=" + encodeURIComponent(value))
          .then(function (response) {
            return response.json();
          })
          .then(function (json) {
            return json.available;
          });
      },
      errorMessage: "email already taken",
    },
  ])
  .addField("#password", [
    {
      rule: "required",
      errorMessage: "password is required",
    },
    {
      rule: "password",
    },
  ])

  .onSuccess((event) => {
    document.getElementById("formregister").submit();
  });
