/**
 * Created by nuntius on 9/2/16.
 */

$( document ).ready(function(event) {
    $('.hand_gesture').on('click',function(e){
        var id = $(this).attr("id");
        //console.log(this);

        $.ajax({
            type: 'POST',
            dataType:'json',
            url: '/ajax?id='+id,
            success: function (response){
                //console.log(response);

                /*
                Hit F12 to see what is being pulled back in the JavaScript console.
                This AJAX request receives a JSON object back from the server.
                The first object is data to show the gameplay of the hand.
                The second object is to update the statistics display.
                */

                //parseJSON handles the return as an object
                var dataObj = $.parseJSON(response);
                console.log(dataObj);

                //Populate the user panels with the correct gestures
                $("#p1Panel").html("<i class='"+dataObj[0].p1GestureFA+"' aria-hidden='true'></i><br>"+dataObj[0].p1Gesture+"");
                $("#p2Panel").html("<i class='"+dataObj[0].p2GestureFA+"' aria-hidden='true'></i><br>"+dataObj[0].p2Gesture+"");

                //Write the events of the battle
                $("#battlePanel").html(
                    dataObj[0].winnerGesture+' '+dataObj[0].action+' '+dataObj[0].loserGesture
                    +'<h2 class="outcome">'+ dataObj[0].outcomeText + '! </h2>'
                );

                //HTML format the User stats:
                var statHTML="<strong>User Stats:</strong><br>"
                +"Wins: "+dataObj[1].win+"<br>"
                +"Losses: "+dataObj[1].lose+"<br>"
                +"Draws: "+dataObj[1].draw+"<br>"
                +"<br><strong>User Gestures:</strong><br>";

                //HTML format the User gestures history
                var ugest = dataObj[1].user_gestures;
                for(i=0;i<ugest.length;i++){
                    statHTML+=ugest[i].gesture_count+" "+ugest[i].gesture+"<br>";
                }

                //HTML format the Computer gesture history:
                statHTML+="<br><strong>Computer Gestures:</strong><br>";
                var cgest = dataObj[1].computer_gestures;
                for(i=0;i<cgest.length;i++){
                    statHTML+=cgest[i].gesture_count+" "+cgest[i].gesture+"<br>";
                }

                //Write all the stats to the stats container
                $("#stats").html(statHTML);


            }

        });


        e.preventDefault();
    });
});