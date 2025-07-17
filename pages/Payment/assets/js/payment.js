document.addEventListener("DOMContentLoaded", function () {
  const radios = document.querySelectorAll('input[name="payment_method"]');
  const hiddenInput = document.getElementById("selected-payment-method");

  const bitcoinFields = document.getElementById("bitcoin-fields");
  const inPersonFields = document.getElementById("in-person-fields");

  // Hide both field sections initially
  function hideAll() {
    bitcoinFields.classList.add("hidden");
    inPersonFields.classList.add("hidden");

    // Remove required attributes from all payment inputs
    bitcoinFields.querySelectorAll("input, textarea").forEach((el) => {
      el.required = false;
    });
    inPersonFields.querySelectorAll("input, textarea").forEach((el) => {
      el.required = false;
    });
  }

  // Show appropriate fields and apply `required` only to visible inputs
  function showFields(method) {
    hideAll();
    hiddenInput.value = method;

    if (method === "Bitcoin") {
      bitcoinFields.classList.remove("hidden");
      bitcoinFields.querySelectorAll("input, textarea").forEach((el) => {
        el.required = true;
      });
    } else if (method === "In Person") {
      inPersonFields.classList.remove("hidden");
      inPersonFields.querySelectorAll("input, textarea").forEach((el) => {
        el.required = true;
      });
    }
  }

  // Attach event listener to each radio button
  radios.forEach((r) => {
    r.addEventListener("change", () => showFields(r.value));
  });

  // Set initial visibility based on default selection
  const defaultSelected = document.querySelector(
    'input[name="payment_method"]:checked'
  );
  if (defaultSelected) showFields(defaultSelected.value);

  // Handle copy to clipboard
  const copyBtn = document.querySelector(".copy-button");
  if (copyBtn) {
    copyBtn.addEventListener("click", function () {
      const address = document.getElementById("payment-address").textContent;
      navigator.clipboard?.writeText(address).then(() => {
        const original = copyBtn.innerHTML;
        copyBtn.innerHTML = '<i class="fas fa-check"></i> Copied!';
        copyBtn.style.backgroundColor = "#28a745";
        setTimeout(() => {
          copyBtn.innerHTML = original;
          copyBtn.style.backgroundColor = "";
        }, 2000);
      });
    });
  }
});

document.querySelector("form").addEventListener("submit", function (e) {
  const transactionId = document.querySelector(
    'input[name="transaction_id"]'
  ).value;
  if (!transactionId) {
    e.preventDefault();
    alert("Transaction ID is missing. Please go back to the order page.");
  }
});
