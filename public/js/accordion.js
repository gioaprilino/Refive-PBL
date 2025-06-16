document.addEventListener('DOMContentLoaded', function() {
    const accordionBtns = document.querySelectorAll('.accordion-button');
    
    accordionBtns.forEach(btn => {
      btn.addEventListener('click', function() {
        const targetId = this.dataset.accordion;
        const targetAccordion = document.getElementById(targetId);
        const arrowIcon = this.querySelector('.arrow img');
  
        btn.classList.toggle('open');
        targetAccordion.classList.toggle('hide');

        if (targetAccordion.classList.contains('hide')) {
          targetAccordion.style.maxHeight = "0";
        } else {
          targetAccordion.style.maxHeight = targetAccordion.scrollHeight + "px";
        }

        // Toggle rotation of the arrow
        arrowIcon.classList.toggle('rotate-180');
      });
    });
});