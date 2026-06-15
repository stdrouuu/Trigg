$(document).ready(function () {
  /* Accordion Toggle */
  $(".faq-question-trigger").click(function () {
    var faqItem = $(this).closest(".faq-item");
    var isActive = faqItem.hasClass("active");

    /* Close all items, then open the clicked one (if it wasn't already open) */
    $(".faq-item").removeClass("active");
    if (!isActive) {
      faqItem.addClass("active");
    }
  });

  /* Search Filter */
  $("#faqSearchInput").on("input", function () {
    var query = $(this).val().toLowerCase().trim();
    var matchCount = 0;

    $(".faq-category-card").each(function () {
      var card = $(this);
      var cardHasMatch = false;

      card.find(".faq-item").each(function () {
        var question = $(this)
          .find(".faq-question-trigger span")
          .text()
          .toLowerCase();
        var answer = $(this).find(".faq-question-answer").text().toLowerCase();

        if (question.includes(query) || answer.includes(query)) {
          $(this).show();
          cardHasMatch = true;
          matchCount++;
        } else {
          $(this).hide();
        }
      });

      /* Show / hide the entire category card */
      if (cardHasMatch || query === "") {
        card.show();
      } else {
        card.hide();
      }
    });

    /* No results message */
    if (matchCount === 0 && query !== "") {
      $("#faqGrid").hide();
      $("#faqNoResults").show();
    } else {
      $("#faqNoResults").hide();
      $("#faqGrid").show();
    }
  });
});
