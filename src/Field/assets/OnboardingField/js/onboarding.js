import {steps} from './onboarding-steps.js';

jQuery(document).ready(function ($) {
    let currentStep = 0;
    $('#onboarding-button').on('click', function () {
        currentStep = 0;
        console.log('onboarding button clicked');
        startOnboarding();
    });

    $('body').on('click', 'button.nextStepBtn', function (e) {
        e.preventDefault();
        removeHighlight(steps[currentStep]);
        currentStep++;
        if (currentStep < steps.length) {
            highlightStep(steps[currentStep]);
        }
    });

    function startOnboarding() {
        console.log('starting onboarding');
        highlightStep(steps[currentStep]);
    }

    function highlightStep(step) {
        let btnText = (currentStep === steps.length - 1) ? 'Finish' : 'Next';
        let $element = $(step.selector);
        if (step.findParent) {
            $element = $element.closest('div.control-group');
        }

        $element.addClass('nxd-onboarding-highlight');

        // add infotext bubbble to the element
        let intro = step.intro;
        let position = step.position ? step.position : 'left';
        let tooltip = $('<div class="nxd-onboarding-tooltip nxd-tooltip-position-'+position+'">' + intro + '<br><button class="nextStepBtn">'+btnText+'</button></div>');
        $element.append(tooltip);

        $([document.documentElement, document.body]).animate({
            scrollTop: $element.offset().top
        }, 1000);
    }

    function removeHighlight(step) {
        // Identify the element
        let $element = $(step.selector);
        if (step.findParent) {
            $element = $element.closest('div.control-group');
        }
        // Remove the highlight
        $element.removeClass('nxd-onboarding-highlight');
        // Remove the tooltip
        $element.find('.nxd-onboarding-tooltip').remove();
    }
});