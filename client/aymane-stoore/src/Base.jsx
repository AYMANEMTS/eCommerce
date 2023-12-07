import Navbar from "./parts/Navbar.jsx";
import Footer from "./parts/footer.jsx";
import {Outlet} from "react-router-dom";

function Base() {
    return (
        <>
            <Navbar />

                <Outlet />

            <Footer />
        </>
    );
}

export default Base;