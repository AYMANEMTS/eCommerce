import "../../style/carsoul.css"
import {Button} from "../../componets/ui/button.jsx";
import {useEffect, useState} from "react";
import {Label} from "../../componets/ui/label.jsx";
import {Input} from "../../componets/ui/input.jsx";
import {useForm} from "react-hook-form";
import Slider from "./Slider.jsx";
import ProductSection from "./ProductSection.jsx";
import axios from "axios";
import {useNavigate} from "react-router-dom";
import {Loader} from "lucide-react";
function CashDetail({product}) {
    const [dataImages, setDataImages] = useState([]);
    const navigate = useNavigate()
    useEffect(() => {
        const initialImage = {
            image: `http://127.0.0.1:8000/storage/${product?.image}`,
            caption: "",
        };
        setDataImages([initialImage]);
        if (product?.images) {
            const productImages = product.images.map((img) => ({
                image: `http://127.0.0.1:8000/storage/${img.path}`,
                caption: "",
            }));

            setDataImages((prevState) => [...prevState, ...productImages]);
        }
    }, [product]);
    const {register,handleSubmit,formState:{errors,isValid,isSubmitting}} = useForm()
    const [orderForm, setOrderForm] = useState(false)
    const handleOrdring = async (data) => {
        const req = await axios.post('http://localhost:8000/api/createOrder',data)
        if (req.data.status === "success"){
            navigate("/thank-you")
        }
    }
    return (
       <>
           <section className="py-10 font-poppins dark:bg-slate-950">
               <div className="max-w-6xl px-4 mx-auto">
                   <div className="flex flex-wrap mb-24 -mx-4">
                       <div className="w-full px-4 mb-8 md:w-1/2 md:mb-0">
                           <div className="sticky top-0  ">
                               <div className="relative mb-6 lg:mb-10 lg:h-96">
                                   <Slider dataImages={dataImages} mainImage={product?.image}/>
                               </div>
                           </div>
                       </div>
                       <div className="w-full px-4 md:w-1/2">
                           <div className="lg:pl-20">
                               <div className="mb-6 ">
                                    <span className="px-2.5 py-0.5 text-xs text-blue-600 bg-blue-100 dark:bg-gray-700 rounded-xl dark:text-gray-200">
                                        {product?.category?.name}
                                    </span>
                                   <h2 className="max-w-xl mt-6 mb-6 text-xl font-semibold leading-loose tracking-wide text-gray-700 md:text-2xl dark:text-gray-300">
                                       {product?.title}
                                   </h2>
                                   <div className="flex flex-wrap items-center mb-6">
                                       <ul className="flex mb-4 mr-2 lg:mb-0">
                                           <li>
                                               <a href="#">
                                                   <svg xmlns="http://www.w3.org/2000/svg" width="16" height="16" fill="currentColor" className="w-4 mr-1 text-red-500 dark:text-gray-400 bi bi-star " viewBox="0 0 16 16">
                                                       <path d="M2.866 14.85c-.078.444.36.791.746.593l4.39-2.256 4.389 2.256c.386.198.824-.149.746-.592l-.83-4.73 3.522-3.356c.33-.314.16-.888-.282-.95l-4.898-.696L8.465.792a.513.513 0 0 0-.927 0L5.354 5.12l-4.898.696c-.441.062-.612.636-.283.95l3.523 3.356-.83 4.73zm4.905-2.767-3.686 1.894.694-3.957a.565.565 0 0 0-.163-.505L1.71 6.745l4.052-.576a.525.525 0 0 0 .393-.288L8 2.223l1.847 3.658a.525.525 0 0 0 .393.288l4.052.575-2.906 2.77a.565.565 0 0 0-.163.506l.694 3.957-3.686-1.894a.503.503 0 0 0-.461 0z">
                                                       </path>
                                                   </svg>
                                               </a>
                                           </li>
                                           <li>
                                               <a href="#">
                                                   <svg xmlns="http://www.w3.org/2000/svg" width="16" height="16" fill="currentColor" className="w-4 mr-1 text-red-500 dark:text-gray-400 bi bi-star " viewBox="0 0 16 16">
                                                       <path d="M2.866 14.85c-.078.444.36.791.746.593l4.39-2.256 4.389 2.256c.386.198.824-.149.746-.592l-.83-4.73 3.522-3.356c.33-.314.16-.888-.282-.95l-4.898-.696L8.465.792a.513.513 0 0 0-.927 0L5.354 5.12l-4.898.696c-.441.062-.612.636-.283.95l3.523 3.356-.83 4.73zm4.905-2.767-3.686 1.894.694-3.957a.565.565 0 0 0-.163-.505L1.71 6.745l4.052-.576a.525.525 0 0 0 .393-.288L8 2.223l1.847 3.658a.525.525 0 0 0 .393.288l4.052.575-2.906 2.77a.565.565 0 0 0-.163.506l.694 3.957-3.686-1.894a.503.503 0 0 0-.461 0z">
                                                       </path>
                                                   </svg>
                                               </a>
                                           </li>
                                           <li>
                                               <a href="#">
                                                   <svg xmlns="http://www.w3.org/2000/svg" width="16" height="16" fill="currentColor" className="w-4 mr-1 text-red-500 dark:text-gray-400 bi bi-star " viewBox="0 0 16 16">
                                                       <path d="M2.866 14.85c-.078.444.36.791.746.593l4.39-2.256 4.389 2.256c.386.198.824-.149.746-.592l-.83-4.73 3.522-3.356c.33-.314.16-.888-.282-.95l-4.898-.696L8.465.792a.513.513 0 0 0-.927 0L5.354 5.12l-4.898.696c-.441.062-.612.636-.283.95l3.523 3.356-.83 4.73zm4.905-2.767-3.686 1.894.694-3.957a.565.565 0 0 0-.163-.505L1.71 6.745l4.052-.576a.525.525 0 0 0 .393-.288L8 2.223l1.847 3.658a.525.525 0 0 0 .393.288l4.052.575-2.906 2.77a.565.565 0 0 0-.163.506l.694 3.957-3.686-1.894a.503.503 0 0 0-.461 0z">
                                                       </path>
                                                   </svg>
                                               </a>
                                           </li>
                                           <li>
                                               <a href="#">
                                                   <svg xmlns="http://www.w3.org/2000/svg" width="16" height="16" fill="currentColor" className="w-4 mr-1 text-red-500 dark:text-gray-400 bi bi-star " viewBox="0 0 16 16">
                                                       <path d="M2.866 14.85c-.078.444.36.791.746.593l4.39-2.256 4.389 2.256c.386.198.824-.149.746-.592l-.83-4.73 3.522-3.356c.33-.314.16-.888-.282-.95l-4.898-.696L8.465.792a.513.513 0 0 0-.927 0L5.354 5.12l-4.898.696c-.441.062-.612.636-.283.95l3.523 3.356-.83 4.73zm4.905-2.767-3.686 1.894.694-3.957a.565.565 0 0 0-.163-.505L1.71 6.745l4.052-.576a.525.525 0 0 0 .393-.288L8 2.223l1.847 3.658a.525.525 0 0 0 .393.288l4.052.575-2.906 2.77a.565.565 0 0 0-.163.506l.694 3.957-3.686-1.894a.503.503 0 0 0-.461 0z">
                                                       </path>
                                                   </svg>
                                               </a>
                                           </li>
                                       </ul>

                                   </div>
                                   <p className="inline-block text-2xl font-semibold text-gray-700 dark:text-gray-400 ">
                                       <span>${product?.price}</span>
                                       <span className="ml-3 text-base font-normal text-gray-500 line-through dark:text-gray-400">$10,000.00</span>
                                   </p>
                               </div>
                               <div className="mb-6">
                                   <h2 className="mb-2 text-lg font-bold text-gray-700 dark:text-gray-400">Description :</h2>
                                   <div className="bg-gray-100 dark:bg-gray-700 rounded-xl">
                                       <div className="p-3 lg:p-5 ">
                                           <div className="p-2 rounded-xl lg:p-6 dark:bg-gray-800 bg-gray-50">
                                               <div className="flex flex-wrap justify-center gap-x-10 gap-y-4">
                                                   {product?.description}
                                               </div>
                                           </div>
                                       </div>
                                   </div>
                               </div>
                               <div className={`py-6 mb-6 border-t ${orderForm?'border-b':''}  border-gray-200 dark:border-gray-700`}>
                                   <Button onClick={() => setOrderForm(!orderForm)} variant={"outline"} className={"rounded w-full"}>
                                       <svg xmlns="http://www.w3.org/2000/svg" className={"m-1"} height="1em" viewBox="0 0 576 512">
                                           <path d="M288 80c-65.2 0-118.8 29.6-159.9 67.7C89.6 183.5 63 226 49.4 256c13.6 30 40.2 72.5 78.6 108.3C169.2 402.4 222.8 432 288 432s118.8-29.6 159.9-67.7C486.4 328.5 513 286 526.6 256c-13.6-30-40.2-72.5-78.6-108.3C406.8 109.6 353.2 80 288 80zM95.4 112.6C142.5 68.8 207.2 32 288 32s145.5 36.8 192.6 80.6c46.8 43.5 78.1 95.4 93 131.1c3.3 7.9 3.3 16.7 0 24.6c-14.9 35.7-46.2 87.7-93 131.1C433.5 443.2 368.8 480 288 480s-145.5-36.8-192.6-80.6C48.6 356 17.3 304 2.5 268.3c-3.3-7.9-3.3-16.7 0-24.6C17.3 208 48.6 156 95.4 112.6zM288 336c44.2 0 80-35.8 80-80s-35.8-80-80-80c-.7 0-1.3 0-2 0c1.3 5.1 2 10.5 2 16c0 35.3-28.7 64-64 64c-5.5 0-10.9-.7-16-2c0 .7 0 1.3 0 2c0 44.2 35.8 80 80 80zm0-208a128 128 0 1 1 0 256 128 128 0 1 1 0-256z"/></svg>
                                       Order now
                                   </Button>
                               </div>
                               {orderForm &&
                                   <form id="formOrdring">
                                       <div className={"grid grid-cols-2 gap-1"}>
                                           <div>
                                               <Label >Full name</Label>
                                               <Input {...register('fullName',{
                                                   required:{
                                                       value:true,message:"the full name field is required"
                                                   }
                                               })} type={"text"} />
                                               {errors?.fullName && <span className={"text-red-600"}>{errors.fullName.message}</span>}
                                           </div>
                                           <div>
                                               <Label >Email</Label>
                                               <Input {...register('email',{
                                                   required:{
                                                       value:true,message:"the email field is required"
                                                   },
                                                   pattern:{
                                                       value:/^\S+@\S+\.\S+$/,message:"the email is not valid format"
                                                   }
                                               })} type={"email"} />
                                               {errors?.email && <span className={"text-red-600"}>{errors.email.message}</span>}
                                           </div>
                                           <div>
                                               <Label >Phone</Label>
                                               <Input {...register('phone',{
                                                   required:{
                                                       value:true,message:"the phone field is required"
                                                   },
                                                   valueAsNumber:true
                                               })} type={"number"} />
                                               {errors?.phone && <span className={"text-red-600"}>{errors.phone.message}</span>}
                                           </div>
                                           <div>
                                               <Label >Address</Label>
                                               <Input {...register('address',{
                                                   required:{
                                                       value:true,message:"the address field is required"
                                                   }
                                               })} type={"text"} />
                                               {errors?.address && <span className={"text-red-600"}>{errors.address.message}</span>}
                                           </div>
                                           <input hidden={true} value={product.id} {...register('product_id')}/>
                                           <div className={"col-span-2 mt-1"}>
                                               <Button disabled={!isValid || isSubmitting} onClick={handleSubmit(handleOrdring)} variant={"default"} className={"rounded w-full"}>
                                                   {isSubmitting && <Loader className={"my-2 mx-2 animate-spin"} />}{'  '}  Send
                                               </Button>
                                           </div>
                                       </div>
                                   </form>
                               }
                           </div>
                       </div>
                       <div className={"container lg:mt-[20rem] "} >
                           {product?.sections &&
                               <ProductSection sections={product.sections} />
                           }

                       </div>
                   </div>
               </div>

           </section>
       </>
    );
}

export default CashDetail;