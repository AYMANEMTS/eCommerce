import {Link} from "react-router-dom";
import {Button} from "../componets/ui/button.jsx";

function Contact() {
    return (
        <>
            <div className="container my-24 mx-auto md:px-6">
                <section className="mb-32">
                    <div className="flex flex-wrap">
                        <div className="mb-12 w-full shrink-0 grow-0 basis-auto md:mb-0 md:w-7/12 md:px-3 lg:px-6">
                            <h2 className="mb-8 text-3xl font-bold">Frequently asked questions</h2>
                            <p className="mb-2 font-bold">Anim pariatur cliche reprehenderit?</p>
                            <p className="mb-8 text-neutral-500 dark:text-neutral-300">
                                Lorem ipsum dolor sit amet consectetur, adipisicing elit. Sunt
                                autem numquam dolore molestias aperiam culpa alias veritatis
                                architecto eos, molestiae vitae ex eligendi libero eveniet
                                dolorem, doloremque rem aliquid perferendis.
                            </p>
                            <p className="mb-2 font-bold">Non cupidatat skateboard dolor brunch?</p>
                            <p className="mb-8 text-neutral-500 dark:text-neutral-300">
                                Distinctio corporis, iure facere ducimus quos consectetur ipsa ut
                                magnam autem doloremque ex! Id, sequi. Voluptatum magnam sed fugit
                                iusto minus et suscipit? Minima sunt at nulla tenetur, numquam
                                unde quod modi magnam ab deserunt ipsam sint aliquid dolores
                                libero repellendus cupiditate mollitia quidem dolorem odit
                            </p>
                            <p className="mb-2 font-bold">
                                Praesentium voluptatibus temporibus consequatur non aspernatur?
                            </p>
                            <p className="mb-8 text-neutral-500 dark:text-neutral-300">
                                Minima sunt at nulla tenetur, numquam unde quod modi magnam ab
                                deserunt ipsam sint aliquid dolores libero repellendus cupiditate
                                mollitia quidem dolorem.
                            </p>

                            <p className="mb-2 font-bold">
                                Voluptatum magnam sed fugit iusto minus et suscipit?
                            </p>
                            <p className="text-neutral-500 dark:text-neutral-300">
                                Laudantium perferendis, est alias iure ut veniam suscipit dolorem
                                fugit. Et ipsam corporis earum ea ut quae cum non iusto blanditiis
                                ipsum dolor eius reiciendis, velit adipisci quas.
                            </p>
                        </div>
                        <div className="w-full shrink-0 grow-0 basis-auto md:w-5/12 md:px-3 lg:px-6">
                            <p className="mb-8 font-bold">
                                Didn't find your answer in the FAQ? Contact our sales
                            </p>
                            <form>
                                <div className="relative mb-6" data-te-input-wrapper-init>
                                    <input type="text"
                                           className="peer block min-h-[auto] w-full rounded border-1 bg-transparent py-[0.32rem] px-3 leading-[1.6] outline-none transition-all duration-200 ease-linear focus:placeholder:opacity-100 peer-focus:text-primary data-[te-input-state-active]:placeholder:opacity-100 motion-reduce:transition-none dark:text-neutral-200 dark:placeholder:text-neutral-200 dark:peer-focus:text-primary [&:not([data-te-input-placeholder-active])]:placeholder:opacity-0"
                                           id="exampleInput90" placeholder="Name" />
                                    <label
                                        className="pointer-events-none absolute top-0 left-3 mb-0 max-w-[90%] origin-[0_0] truncate pt-[0.37rem] leading-[1.6] text-neutral-500 transition-all duration-200 ease-out peer-focus:-translate-y-[0.9rem] peer-focus:scale-[0.8] peer-focus:text-primary peer-data-[te-input-state-active]:-translate-y-[0.9rem] peer-data-[te-input-state-active]:scale-[0.8] motion-reduce:transition-none dark:text-neutral-200 dark:peer-focus:text-primary"
                                        htmlFor="exampleInput90">Name
                                    </label>
                                </div>
                                <div className="relative mb-6" data-te-input-wrapper-init>
                                    <input type="email"
                                           className="peer block min-h-[auto] w-full rounded border-0 bg-transparent py-[0.32rem] px-3 leading-[1.6] outline-none transition-all duration-200 ease-linear focus:placeholder:opacity-100 peer-focus:text-primary data-[te-input-state-active]:placeholder:opacity-100 motion-reduce:transition-none dark:text-neutral-200 dark:placeholder:text-neutral-200 dark:peer-focus:text-primary [&:not([data-te-input-placeholder-active])]:placeholder:opacity-0"
                                           id="exampleInput91" placeholder="Email address" />
                                    <label
                                        className="pointer-events-none absolute top-0 left-3 mb-0 max-w-[90%] origin-[0_0] truncate pt-[0.37rem] leading-[1.6] text-neutral-500 transition-all duration-200 ease-out peer-focus:-translate-y-[0.9rem] peer-focus:scale-[0.8] peer-focus:text-primary peer-data-[te-input-state-active]:-translate-y-[0.9rem] peer-data-[te-input-state-active]:scale-[0.8] motion-reduce:transition-none dark:text-neutral-200 dark:peer-focus:text-primary"
                                        htmlFor="exampleInput91">Email address
                                    </label>
                                </div>
                                <div className="relative mb-6" data-te-input-wrapper-init>
            <textarea
                className="peer block min-h-[auto] w-full rounded border-0 bg-transparent py-[0.32rem] px-3 leading-[1.6] outline-none transition-all duration-200 ease-linear focus:placeholder:opacity-100 data-[te-input-state-active]:placeholder:opacity-100 motion-reduce:transition-none dark:text-neutral-200 dark:placeholder:text-neutral-200 [&:not([data-te-input-placeholder-active])]:placeholder:opacity-0"
                id="exampleFormControlTextarea1" rows="3" placeholder="Your message"></textarea>
                                    <label htmlFor="exampleFormControlTextarea1"
                                           className="pointer-events-none absolute top-0 left-3 mb-0 max-w-[90%] origin-[0_0] truncate pt-[0.37rem] leading-[1.6] text-neutral-500 transition-all duration-200 ease-out peer-focus:-translate-y-[0.9rem] peer-focus:scale-[0.8] peer-focus:text-primary peer-data-[te-input-state-active]:-translate-y-[0.9rem] peer-data-[te-input-state-active]:scale-[0.8] motion-reduce:transition-none dark:text-neutral-200 dark:peer-focus:text-primary">Message</label>
                                </div>
                                <div className="mb-6 inline-block min-h-[1.5rem] justify-center pl-[1.5rem] md:flex">
                                    <input
                                        className="relative float-left mt-[0.15rem] mr-[6px] -ml-[1.5rem] h-[1.125rem] w-[1.125rem] appearance-none rounded-[0.25rem] border-[0.125rem] border-solid border-neutral-300 outline-none before:pointer-events-none before:absolute before:h-[0.875rem] before:w-[0.875rem] before:scale-0 before:rounded-full before:bg-transparent before:opacity-0 before:shadow-[0px_0px_0px_13px_transparent] before:content-[''] checked:border-primary checked:bg-primary checked:before:opacity-[0.16] checked:after:absolute checked:after:ml-[0.25rem] checked:after:-mt-px checked:after:block checked:after:h-[0.8125rem] checked:after:w-[0.375rem] checked:after:rotate-45 checked:after:border-[0.125rem] checked:after:border-t-0 checked:after:border-l-0 checked:after:border-solid checked:after:border-white checked:after:bg-transparent checked:after:content-[''] hover:cursor-pointer hover:before:opacity-[0.04] hover:before:shadow-[0px_0px_0px_13px_rgba(0,0,0,0.6)] focus:shadow-none focus:transition-[border-color_0.2s] focus:before:scale-100 focus:before:opacity-[0.12] focus:before:shadow-[0px_0px_0px_13px_rgba(0,0,0,0.6)] focus:before:transition-[box-shadow_0.2s,transform_0.2s] focus:after:absolute focus:after:z-[1] focus:after:block focus:after:h-[0.875rem] focus:after:w-[0.875rem] focus:after:rounded-[0.125rem] focus:after:content-[''] checked:focus:before:scale-100 checked:focus:before:shadow-[0px_0px_0px_13px_#3b71ca] checked:focus:before:transition-[box-shadow_0.2s,transform_0.2s] checked:focus:after:ml-[0.25rem] checked:focus:after:-mt-px checked:focus:after:h-[0.8125rem] checked:focus:after:w-[0.375rem] checked:focus:after:rotate-45 checked:focus:after:rounded-none checked:focus:after:border-[0.125rem] checked:focus:after:border-t-0 checked:focus:after:border-l-0 checked:focus:after:border-solid checked:focus:after:border-white checked:focus:after:bg-transparent dark:border-neutral-600 dark:checked:border-primary dark:checked:bg-primary dark:focus:before:shadow-[0px_0px_0px_13px_rgba(255,255,255,0.4)] dark:checked:focus:before:shadow-[0px_0px_0px_13px_#3b71ca]"
                                        type="checkbox" value="" id="exampleCheck96"  />
                                    <label className="inline-block pl-[0.15rem] hover:cursor-pointer" htmlFor="exampleCheck96">
                                        Send me a copy of this message
                                    </label>
                                </div>
                                <Button variant="outline" className="hover:bg-yellow-500 rounded w-full">
                                    <span >Send</span>
                                </Button>
                            </form>
                        </div>
                    </div>
                </section>
            </div>
        </>
    );
}

export default Contact;