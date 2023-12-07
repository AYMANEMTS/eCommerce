import {BrowserRouter, Route , Routes} from "react-router-dom";
import Base from "../Base.jsx";
import Home from "../pages/Home.jsx";
import Store from "../pages/Store.jsx";
import About from "../pages/About.jsx";
import Contact from "../pages/Contact.jsx";
import Detail from "../pages/Detail.jsx";
import ThankYouOrdering from "@/myComponets/productDetail/ThankYouOrdering.jsx";
import PaymentCard from "@/myComponets/productDetail/PaymentCard.jsx";


export default function RoutesPages(){
    return (
        <BrowserRouter>
            <Routes>
                <Route path={"/"} element={<Base />}>
                    <Route index element={<Home />} />
                    <Route path={"/store"} element={<Store />} />
                    <Route path={"/about"} element={<About />} />
                    <Route path={"/contact"} element={<Contact />} />
                    <Route path={"/product/:id"} element={<Detail />} />
                    <Route path={"/thank-you"} element={<ThankYouOrdering />} />
                </Route>
            </Routes>
        </BrowserRouter>
    )
}