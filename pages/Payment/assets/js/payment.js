document.addEventListener("DOMContentLoaded", function () {
  const radios = document.querySelectorAll('input[name="payment_method"]');
  const hiddenInput = document.getElementById("selected-payment-method");

  const bitcoinFields = document.getElementById("bitcoin-fields");
  const inPersonFields = document.getElementById("in-person-fields");

  function hideAll() {
    bitcoinFields.classList.add("hidden");
    inPersonFields.classList.add("hidden");
  }

  function showFields(method) {
    hideAll();
    hiddenInput.value = method;

    if (method === "Bitcoin") {
      bitcoinFields.classList.remove("hidden");
    } else if (method === "In Person") {
      inPersonFields.classList.remove("hidden");
    }
  }

  radios.forEach((r) => {
    r.addEventListener("change", () => showFields(r.value));
  });

  const defaultSelected = document.querySelector(
    'input[name="payment_method"]:checked'
  );
  if (defaultSelected) showFields(defaultSelected.value);

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
