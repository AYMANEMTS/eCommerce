import { Carousel } from 'react-carousel-minimal';
import {useEffect, useState} from "react";

function Slider({dataImages , mainImage}) {

    const data = [
        {
            image: "https://upload.wikimedia.org/wikipedia/commons/thumb/0/0c/GoldenGateBridge-001.jpg/1200px-GoldenGateBridge-001.jpg",
            caption: "San Francisco"
        },
        {
            image: "https://cdn.britannica.com/s:800x450,c:crop/35/204435-138-2F2B745A/Time-lapse-hyper-lapse-Isle-Skye-Scotland.jpg",
            caption: "Scotland"
        },
        {
            image: "https://static2.tripoto.com/media/filter/tst/img/735873/TripDocument/1537686560_1537686557954.jpg",
            caption: "Darjeeling"
        },
    ];

    const captionStyle = {
        fontSize: '1em',
        fontWeight: 'bold',
    }
    
    return (
        <div className="App">
            <div style={{ textAlign: "center" }}>
                <div style={{
                    padding: "0 20px"
                }}>
                    {dataImages.length <= 1 ?
                        <img style={{whith:"full"}} src={`http://127.0.0.1:8000/storage/${mainImage}`} />
                        :
                        <Carousel
                            data={dataImages.length > 0 ? dataImages:data}
                            time={2000}
                            width="850px"
                            height="500px"
                            captionStyle={captionStyle}
                            radius="10px"
                            captionPosition="bottom"
                            automatic={true}
                            dots={true}
                            pauseIconColor="white"
                            pauseIconSize="40px"
                            slideBackgroundColor="darkgrey"
                            slideImageFit="cover"
                            thumbnails={true}
                            thumbnailWidth="100px"
                            style={{
                                textAlign: "center",
                                maxWidth: "850px",
                                maxHeight: "500px",
                                margin: "40px auto",
                            }}
                        />
                    }
                </div>
            </div>
        </div>
    );
}

export default Slider;