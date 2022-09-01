bolge1 ={
    merkez:{lat: 36.856742,  lng: 28.274592},
    cevre : 100,
    grup: 3,
};

bolge2 ={
    merkez:{lat: 36.856247,  lng:  28.266437},
    cevre : 100,
    grup: 2,
};

bolge3 ={
    merkez:{lat: 36.858940,   lng: 28.255053},
    cevre : 100,
    grup: 1,
};

bolge4 ={
    merkez:{lat: 36.864763,   lng: 28.269610},
    cevre : 100,
    grup: 2,
};

bolge5 ={
    merkez:{lat: 36.863493,   lng: 28.275427},
    cevre : 100,
    grup: 1,
};

var bölgeler = [bolge1, bolge2, bolge3, bolge4, bolge5];
    

function initMap() {

    //MapTypes : roadmap,terrain,hybrid,satellite
    const map = new google.maps.Map(document.getElementById("map"), {
        zoom: 15,
        center: {lat: 36.856742, lng: 28.274592},
        mapTypeId: "roadmap",
    });

    var renk;

    bölgeler.forEach(bölge => {

        console.log(bölge.grup);
        switch(bölge.grup){

            case 1:
                renk = "#00CC00";
                break;

            case 2:
                renk = "#F07400";
                break;

            case 3:
                renk = "#FF0000";
                break;

            default:
                renk = "#FFF";
                break;
        }

        new google.maps.Circle({
            strokeColor: renk,
            strokeOpacity: 0.8,
            strokeWeight: 2,
            fillColor: renk,
            fillOpacity: 0.20,
            map,
            center: bölge.merkez,
            radius: bölge.cevre,
        });

    });

    
}