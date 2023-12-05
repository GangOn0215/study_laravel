const header = $('#header');
const navList = $('#header nav li.depth-root div');
const navItemList = $('#header nav li.depth-root ul');

$(window).on('load', function() {
    navList.each((index, item) => {
        $(item).on('mouseover', function(e) {
            navItemList.hide();

            $(this).next().show();
        });
    });

    $('#header').on('mouseleave', function(e) {
        navItemList.hide();
    })
})
