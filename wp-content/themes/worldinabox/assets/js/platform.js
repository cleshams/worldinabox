
window.addEventListener('load', function()
{
	loadAll();
});
//
//	Modals
//
function loadAll() {
    initModalForms();
    toggleLessonNav();
    if(document.querySelector('.page-template-page-lesson-plans'))
    {
        populatePDFTitle();
    }
}

function initModalForms()
{

    var openModalButtons = document.querySelectorAll('.trigger-video');


    for(let i = 0; i < openModalButtons.length; i++)
    {
        openModalButtons[i].addEventListener('click', openiFrameModal);
    }
}

function openiFrameModal(e)
{
    console.log(e.target);
    var iframeSrc = e.target.getAttribute('data-src');
    var iframeCode = '<iframe frameborder="0" src="' + iframeSrc + '" allowfullscreen allow="autoplay" autoplay="1"></iframe>';

    let iframeContainer = document.querySelector('.modal');
    let open = iframeContainer.classList.contains('is-open');

    if(open){
        iframeContainer.removeClass('is-open').classList.add('closing');
        setTimeout(function(){
            iframeContainer.classList.add('closed').classList.remove('closing');
            document.querySelector(iframeContainer).find('iframe').remove();
        }, 300);

    }
    else
    {
        iframeContainer.classList.remove('closed')
        iframeContainer.classList.add('opening');
        setTimeout(function(){
            iframeContainer.classList.add('is-open')
            document.querySelector('.iframe-container').insertAdjacentHTML('beforeend',iframeCode);
            setTimeout(function() {iframeContainer.classList.remove('opening')}, 100);
        }, 300);

        iframeContainer.addEventListener('click', function(e) {
            console.log(e.target);
            if(e.target.classList.contains('modal') || e.target.classList.contains('close-modal'))
            {
                iframeContainer.classList.add('closing');
                setTimeout(function() {
                    iframeContainer.classList.add('closed');
                    iframeContainer.classList.remove('closing');
                    iframeContainer.classList.remove('is-open');
                    document.querySelector('.modal iframe').remove();
                }, 300);
            }
        });
    }

}

function toggleLessonNav()
{
    
    const dropdowncontainer = document.querySelector('.dropdown__parent');
    const dropdownSibling = document.querySelector('.dropdown__sibling');

    if(dropdownSibling)
    {
        
        dropdownSibling.addEventListener('focus', function() {
            dropdowncontainer.querySelector('.dropdown').classList.add('open');
            dropdownSibling.classList.add('open');
        });

        document.querySelectorAll('.dropdown a').forEach(function(e, i) {
            e.addEventListener('focus', function()
            {
                dropdowncontainer.querySelector('.dropdown').classList.add('open');
                dropdownSibling.classList.add('open');
            });
        });

        dropdownSibling.addEventListener('mouseenter', function() {
            dropdowncontainer.querySelector('.dropdown').classList.add('open');
            dropdownSibling.classList.add('open');
        });

        dropdownSibling.addEventListener('click', function(e) {
            // if(window.innerWidth < 960)
            // {
                e.target.classList.toggle('open');
                dropdowncontainer.querySelector('.dropdown').classList.toggle('open');
            // }
        });

        const topLevels = document.querySelectorAll('.nav__menu > .nav__item > a');
        topLevels.forEach(function(e, i)
        {
            e.addEventListener('focus', function() {

                if(e.classList.contains('dropdown-sibling'))
                {}
                 else
                {
                    dropdowncontainer.querySelector('.dropdown').classList.remove('open');
                    dropdownSibling.classList.remove('open');
                }
            });
            e.addEventListener('mouseenter', function() {
                if(e.classList.contains('dropdown-sibling'))
                {}
                else
                {
                    dropdowncontainer.querySelector('.dropdown').classList.remove('open');
                    dropdownSibling.classList.remove('open');
                }
            })
        })
    }
}

function populatePDFTitle() {
    var lessonField = document.querySelector('#pdf-lesson');
    var titleInput = document.querySelector('#pdf-title');

    lessonField.addEventListener('change', function(e) {
        if (titleInput.getAttribute('placeholder') || titleInput.value === '') {
            let selectLesson = e.target.options[e.target.selectedIndex].text;
            titleInput.value = selectLesson;
        }
    })
}



/************** */
/* Classes toggle*/
/************** */
const classBlocks = document.querySelectorAll('.classes');

if(classBlocks)
{
    var classQuestions = document.querySelectorAll('.expand-class')
    classQuestions.forEach(function(i,d)
    {
        i.addEventListener('click', function() {
            i.classList.toggle('open');
            console.log(i.nextElementSibling);
            if(i.nextElementSibling.classList.contains('open'))
            {
                i.nextElementSibling.style.maxHeight = "0px";
                i.nextElementSibling.style.padding = "0 10px";
            }
            else{
                var height = i.nextElementSibling.scrollHeight + 20;
                i.nextElementSibling.style.maxHeight = '' + height + 'px';
                i.nextElementSibling.style.padding = "10px";
            }
            i.nextElementSibling.classList.toggle('open');
        })
    })
}



/************** */
/* Lesson form */
/************** */


function initModalForms()
{

    var openModalButtons = document.querySelectorAll('.submit-minutes');


    for(let i = 0; i < openModalButtons.length; i++)
    {
        openModalButtons[i].addEventListener('click', openFormModal);
    }
}

function openFormModal(e)
{
    let classNum = e.target.getAttribute('data-classnum');
    console.log(classNum);
    let formContainer = document.querySelector('.lesson-minutes-container[data-classnum="'+classNum+'"]');
    let open = formContainer.classList.contains('is-open');

    if(open){
        formContainer.removeClass('is-open').classList.add('closing');
        setTimeout(function(){
            formContainer.classList.add('closed').classList.remove('closing');
        }, 300);

    }
    else
    {
        formContainer.classList.remove('closed')
        formContainer.classList.add('opening');
        setTimeout(function(){
            formContainer.classList.add('is-open')
            setTimeout(function() {formContainer.classList.remove('opening')}, 100);
        }, 300);

        formContainer.addEventListener('click', function(e) {
            console.log(e.target);
            if(e.target.classList.contains('lesson-minutes-container') || e.target.classList.contains('close-modal'))
            {
                formContainer.classList.add('closing');
                setTimeout(function() {
                    formContainer.classList.add('closed');
                    formContainer.classList.remove('closing');
                    formContainer.classList.remove('is-open');
                }, 300);
            }
        });
    }

}


