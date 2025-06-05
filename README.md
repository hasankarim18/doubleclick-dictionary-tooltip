# Doubleclick Dictionary Tooltip using [dictionaryapi.dev](https://dictionaryapi.dev/) api.

## This is a simple JAVASCRIPT code

```
console.log("DoubleClick Dictionary Tooltip Plugin Loaded");

document.addEventListener("DOMContentLoaded", function () {
  const tooltip = document.createElement("div");
  tooltip.id = "dcdt-tooltip";
  tooltip.style.display = "none";
  document.body.appendChild(tooltip);

  document.body.addEventListener("dblclick", async function (event) {
    const selection = window.getSelection().toString().trim();
    if (
      !selection ||
      selection.length == 0 ||
      selection.length > 100 ||
      selection.split(/\s+/).length > 1
    ) {
      tooltip.style.display = "none";
      return;
    }

    const word = selection.toLocaleLowerCase();

    tooltip.style.display = "block";
    tooltip.style.position = "absolute";
    tooltip.innerHTML = `<p>Loading...</p>`;
    tooltip.style.left = event.pageX + "px";
    tooltip.style.top = event.pageY + "px";

    try {
      const res = await fetch(
        `https://api.dictionaryapi.dev/api/v2/entries/en/${word}`
      );
      const data = await res.json();
      // console.log("data=>", data[0].meanings[0]);
      if (
        Array.isArray(data) &&
        data.length > 0 &&
        data[0].meanings.length > 0
      ) {
        // console.log(data);
        const defs = data[0].meanings[0].definitions;
        tooltip.innerHTML = `<p> <string>${defs[0].definition}</string> </p>`;
      }
    } catch (error) {
      tooltip.innerHTML = `<p>Error fetching defination</p>`;
      console.log(error);
    }

    setTimeout(() => {
      tooltip.style.display = "none";
      tooltip.innerHTML = "";
    }, 6000);
  });
});

```
