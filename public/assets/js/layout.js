const header = $('#header');
const navList = $('#header nav li.depth-root div');
const navItemList = $('#header nav li.depth-root ul');

$(window).on('load', function() {
    navList.each((index, item) => {
        $(item).on('mouseover', function() {
            navItemList.hide();

            $(this).next().show();
        });
    });

    $('#header').on('mouseleave', function() {
        navItemList.hide();
    });

    $('.project-container .items').on('click', function() {
        if($(this).find('a').attr('href')) {
            location.href = $(this).find('a').attr('href');
        }
    });
})
