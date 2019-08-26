
window.addEventListener('load', function()
{
	loadAll();
});
//
//	Modals
//
function loadAll() {
    initModals();
    toggleLessonNav()
}

function initModals()
{

    var openModalButtons = document.querySelectorAll('.play');


    for(let i = 0; i < openModalButtons.length; i++)
    {
        openModalButtons[i].addEventListener('click', openVimeoModal);
    }
}

function openVimeoModal(e)
{
    var vimeoId = e.target.getAttribute('data-id');

    var iframeSrc = 'https://player.vimeo.com/video/' + parseInt(vimeoId) + '?autoplay=1&title=0';
    var iframeCode = '<iframe frameborder="0" src="' + iframeSrc + '"></iframe>';

    let vimeoContainer = document.querySelector('.modal');
    let open = vimeoContainer.classList.contains('is-open');

    if(open){
        vimeoContainer.removeClass('is-open').classList.add('closing');
        setTimeout(function(){
            vimeoContainer.classList.add('closed').classList.remove('closing');
            document.querySelector(vimeoContainer).find('iframe').remove();
        }, 300);

    }
    else
    {
        vimeoContainer.classList.remove('closed')
        vimeoContainer.classList.add('opening');
        setTimeout(function(){
            vimeoContainer.classList.add('is-open')
            document.querySelector('.iframe-container').insertAdjacentHTML('beforeend',iframeCode);
            setTimeout(function() {vimeoContainer.classList.remove('opening')}, 100);
        }, 300);

        vimeoContainer.addEventListener('click', function(e) {
            console.log(e.target);
            if(e.target.classList.contains('modal') || e.target.classList.contains('close-modal'))
            {
                vimeoContainer.classList.add('closing');
                setTimeout(function() {
                    vimeoContainer.classList.add('closed');
                    vimeoContainer.classList.remove('closing');
                    vimeoContainer.classList.remove('is-open');
                    document.querySelector('.modal iframe').remove();
                }, 300);
            }
        });
    }

}

function toggleLessonNav()
{
    
    const dropdowncontainer = document.querySelector('.dropdown__parent');
    const dropownSibling = document.querySelector('.dropdown__sibling');

    if(dropownSibling)
    {
        
        dropownSibling.addEventListener('focus', function() {
            dropdowncontainer.querySelector('.dropdown').classList.add('open');
            dropownSibling.classList.add('open');
        });

        document.querySelectorAll('.dropdown a').forEach(function(e, i) {
            e.addEventListener('focus', function()
            {
                dropdowncontainer.querySelector('.dropdown').classList.add('open');
                dropownSibling.classList.add('open');
            });
        });

        dropownSibling.addEventListener('mouseenter', function() {
            dropdowncontainer.querySelector('.dropdown').classList.add('open');
            dropownSibling.classList.add('open');
        });

        const topLevels = document.querySelectorAll('.nav__menu > .nav__item > a');
        topLevels.forEach(function(e, i)
        {
            e.addEventListener('focus', function() {

                if(e.classList.contains('dropdown-sibling'))
                {
                } else
                {
                    dropdowncontainer.querySelector('.dropdown').classList.remove('open');
                    dropownSibling.classList.remove('open');
                }
            });
            e.addEventListener('mouseenter', function() {
                if(e.classList.contains('dropdown-sibling'))
                {}
                else
                {
                    dropdowncontainer.querySelector('.dropdown').classList.remove('open');
                    dropownSibling.classList.remove('open');
                }
            })
        })
    }
}

