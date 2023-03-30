    //Main  

    function openNav() {
        document.getElementById("sidenav").style.width = "250px";
        document.getElementById("main-panel").style.marginLeft = "250px";
        document.getElementById("openNavSpan").style.display = "none";
    }

    function closeNav() {
        document.getElementById("sidenav").style.width = "0";
        document.getElementById("main-panel").style.marginLeft = "0";
        document.getElementById("openNavSpan").style.display = "block";
    }

    //End Main

    
    // Home
    
    function showFormScheduleService(){
        document.getElementById('btn-open-form-schedule-service').style.display = 'none';
        document.getElementById('form-schedule-service').style.display = 'block';
        document.getElementById('form-schedule-service').setAttribute('class','animate__animated animate__slideInLeft');
    }

    function closeFormScheduleService(){
        document.getElementById('btn-open-form-add-client').style.display = 'block';
        document.getElementById('form-add-client').setAttribute('class','animate__animated animate__slideOutUp');
        setTimeout(function(){
            document.getElementById('form-add-client').style.display = 'none';
        },500)
    }

    // End Home

    
    // Tutorials

    function show_addTutorial(){
        var element = document.getElementById('formAddTutorial');
        element.setAttribute('class','animate__animated animate__slideInDown');
        element.style.display = 'block';
        document.querySelector('.btnshowFormAdd').style.display = 'none';
    }

    function cancel_addTutorial(){
        var element = document.getElementById('formAddTutorial');
        element.setAttribute('class', 'animate__animated animate__slideOutUp');
        setTimeout(function(){
            element.style.display = 'none';
            document.querySelector('.btnshowFormAdd').style.display = 'block';

        },800);
    }

    // End Tutorials

    // Products

    function showFormAddProduct(){
        document.getElementById('form_addProduct').setAttribute('class', 'animate__animated animate__slideInDown');
        document.getElementById('form_addProduct').style.display = 'block';
        document.getElementById('btnshowFormAdd').style.display = 'none';
    }

    function cancelAddProduct(){
        document.getElementById('form_addProduct').setAttribute('class', 'animate__animated animate__slideOutUp');
        setTimeout(function() {
          document.getElementById('form_addProduct').style.display = 'none';
          document.getElementById('btnshowFormAdd').style.display = 'block';
        }, 800);
    }

    // End Products