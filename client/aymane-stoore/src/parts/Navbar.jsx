import {Link, useLocation} from "react-router-dom";
import {useState} from "react";
import "../style/navbar/nav.css"
import Cart from "./Cart.jsx";
import {ModeToggle} from "@/componets/mode-toggle.jsx";
import Favorite from "@/myComponets/favorite/ui/Favorite.jsx";
function Navbar() {
    const location = useLocation()
    const [menuOpen, setMenuOpen] = useState(false);
    const toggleMenu = () => {
        setMenuOpen(!menuOpen)
    };
    return (
        <div className={"mynav"}>
            <div className=" flex flex-col justify-center items-center bg-black">
                <div className=" h-[4rem] ">
                    <p className="text-white text-2xl mt-3">Welcome to my store</p>
                </div>
            </div>

            <div className="flex flex-wrap place-items-center ">
                <section className="relative mx-auto w-full">
                    <nav className="flex justify-between   ">
                        <div className="px-5 xl:px-12 py-6 flex w-full items-center">
                            <a className="text-3xl font-bold font-heading hover:text-yellow-400" href="#">
                            AYMANE STORE
                            </a>
                            <ul className="hidden md:flex px-4 mx-auto font-semibold font-heading space-x-12">
                                <li>
                                    <Link to={"/"}>
                                        <p className="font-bold relative w-max two">
                                            <span>Home</span>
                                            <span className={`absolute -bottom-1 left-1/2 ${location.pathname === '/' ? 'w-full':'w-0' } transition-all h-1 bg-yellow-400`}></span>
                                            <span className={`absolute -bottom-1 right-1/2 ${location.pathname === '/' ? 'w-full':'w-0' } transition-all h-1 bg-yellow-400`}></span>
                                        </p>
                                    </Link>
                                </li>
                                <li>
                                    <Link to={"/store"}>
                                        <p className="font-bold relative w-max two">
                                            <span>Shop</span>
                                            <span className={`absolute -bottom-1 left-1/2 ${location.pathname === '/store' ? 'w-full':'w-0' } transition-all h-1 bg-yellow-400`}></span>
                                            <span className={`absolute -bottom-1 right-1/2 ${location.pathname === '/store' ? 'w-full':'w-0' } transition-all h-1 bg-yellow-400`}></span>
                                        </p>
                                    </Link>
                                </li>
                                <li>
                                    <Link to={"/about"}>
                                        <p className="font-bold relative w-max two">
                                            <span>About us</span>
                                            <span className={`absolute -bottom-1 left-1/2 ${location.pathname === '/about' ? 'w-full':'w-0' } transition-all h-1 bg-yellow-400`}></span>
                                            <span className={`absolute -bottom-1 right-1/2 ${location.pathname === '/about' ? 'w-full':'w-0' } transition-all h-1 bg-yellow-400`}></span>
                                        </p>
                                    </Link>
                                </li>
                                <li>
                                    <Link to={"/contact"}>
                                        <p className="font-bold relative w-max two">
                                            <span>Contact</span>
                                            <span className={`absolute -bottom-1 left-1/2 ${location.pathname === '/contact' ? 'w-full':'w-0' } transition-all h-1 bg-yellow-400`}></span>
                                            <span className={`absolute -bottom-1 right-1/2 ${location.pathname === '/contact' ? 'w-full':'w-0' } transition-all h-1 bg-yellow-400`}></span>
                                        </p>
                                    </Link>
                                </li>
                            </ul>
                            <div className="hidden xl:flex items-center space-x-5 items-center">
                                <a className="hover:text-gray-200" href="#">
                                    <Favorite />
                                </a>
                                <div>
                                    <Cart />
                                </div>
                            <ModeToggle />
                            </div>
                        </div>
                        <div className={"mt-8 mr-4 xl:hidden"}>
                            <Favorite />
                        </div>
                        <div className={"mt-8 mr-4 xl:hidden"}>
                            <Cart />
                        </div>
                        <div className={"mt-8 mr-4 xl:hidden"}>
                            <ModeToggle />
                        </div>
                        <a className="navbar-burger self-center mr-12 xl:hidden" onClick={toggleMenu}>
                            <svg xmlns="http://www.w3.org/2000/svg" className="h-6 w-6 hover:text-gray-200" fill="none" viewBox="0 0 24 24" stroke="currentColor">
                                <path strokeLinecap="round" strokeLinejoin="round" strokeWidth="2" d="M4 6h16M4 12h16M4 18h16" />
                            </svg>
                        </a>
                    </nav>
                    <hr/>
                    {menuOpen && (
                        <ul className="xl:hidden bg-white text-black py-4 px-4">
                            {/* Add your responsive navigation items here */}
                            <li>
                                <a className="text-2xl hover:text-orange-500 " href="#">
                                    Home
                                </a>
                            </li>
                            <li>
                                <a className="text-2xl hover:text-orange-500 " href="#">
                                    Category
                                </a>
                            </li>
                            <li>
                                <a className="text-2xl hover:text-orange-500 " href="#">
                                    Collections
                                </a>
                            </li>
                            <li>
                                <a className="text-2xl hover:text-orange-500 " href="#">
                                    Contact Us
                                </a>
                            </li>
                        </ul>
                    )}
                </section>
            </div>

        </div>
    );
}

export default Navbar;