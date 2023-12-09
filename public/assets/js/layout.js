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

    $.datepicker.setDefaults({
        dateFormat: 'yy-mm-dd',
        monthNames: ['1월', '2월', '3월', '4월', '5월', '6월', '7월', '8월', '9월', '10월', '11월', '12월'],	//한글 캘린더중 월 표시를 위한 부분
        monthNamesShort: ['1월', '2월', '3월', '4월', '5월', '6월', '7월', '8월', '9월', '10월', '11월', '12월'],	//한글 캘린더 중 월 표시를 위한 부분
        dayNames: ['일', '월', '화', '수', '목', '금', '토'],	//한글 캘린더 요일 표시 부분
        dayNamesShort: ['일', '월', '화', '수', '목', '금', '토'],	//한글 요일 표시 부분
        dayNamesMin: ['일', '월', '화', '수', '목', '금', '토'],	// 한글 요일 표시 부분
        showMonthAfterYear: true,	// true : 년 월  false : 월 년 순으로 보여줌
        yearSuffix: '년',	//
        showButtonPanel: true,	// 오늘로 가는 버튼과 달력 닫기 버튼 보기 옵션
        buttonImageOnly: true,	// input 옆에 조그만한 아이콘으로 캘린더 선택가능하게 하기
        buttonImage: "images/calendar.gif",	// 조그만한 아이콘 이미지
        //        buttonText: "Select date"	// 조그만한 아이콘 툴팁
    });
        $( ".datepicker" ).datepicker();
})
