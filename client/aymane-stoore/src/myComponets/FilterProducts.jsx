import {useQuery, useQueryClient} from "react-query";
import {useState} from "react";
import {Card} from "../componets/ui/card.jsx";
import {Label} from "../componets/ui/label.jsx";
import {Input} from "../componets/ui/input.jsx";
import {useForm} from "react-hook-form";

export default function FilterProducts({products}) {
    const [categorySelected, setCategorySelected] = useState([])
    const {register,handleSubmit,reset} = useForm()
    const getCategoriesUsinged = async () =>{
        const response = await fetch('http://127.0.0.1:8000/api/categories/items');
        const data = await response.json()
        return data
    }
    const {data:categoriesUsinged} = useQuery("categoriesUsinged",getCategoriesUsinged,{
        refetchOnWindowFocus:false,
        retry:1,
        cacheTime:50000,
        staleTime:25000,
    })
    const queryClient = useQueryClient()
    const onChangeCategoris = (e) => {
        const id = parseInt(e.currentTarget.dataset.catids);
        if (e.currentTarget.checked) {
            setCategorySelected((prevCategories) => [...prevCategories, id]);
        } else {
            setCategorySelected((prevCategories) =>
                prevCategories.filter((categoryId) => categoryId !== id)
            );
        }
    };
    const getFiltersProducts = (data) => {
        const search = data.searchInput.toLowerCase()
        let filteredProducts = products?.slice()
        if (search !== "") {
            filteredProducts = filteredProducts.filter((item) => item.title.toLowerCase().includes(search));
        }
        if (categorySelected.length > 0) {
            filteredProducts = filteredProducts.filter((item) => categorySelected.includes(item.category_id))
        }
        if (data.min !== "" || data.max !== "") {
            const min = data.min === "" ? 0 : parseFloat(data.min);
            const max = data.max === "" ? Number.MAX_VALUE : parseFloat(data.max);
            filteredProducts = filteredProducts.filter((item) => item.price >= min && item.price <= max)
        }
        queryClient.setQueryData('products',(prevData) => {
            return {...prevData,data:filteredProducts}
        })
    };
    const resetProducts = () => {
        queryClient.invalidateQueries('products')
        setCategorySelected([]);
        reset();
    }

    return (
        <>
            <form onSubmit={handleSubmit(getFiltersProducts)}>
                <Card className="w-[18rem] my-4 p-3">
                    <Label htmlFor="search" className="text-md">
                        Name or description
                    </Label>
                    <Input {...register('searchInput')} id="search" type="text" />
                    <hr className="my-2" />
                    <Label  className="text-md">
                        Categories
                    </Label>
                    {categoriesUsinged?.map((category, key) => {
                        return (
                            <div key={key} className="form-check mt-2">
                                <input
                                    onClick={onChangeCategoris} defaultChecked={categorySelected.includes(category.id)}
                                    className="w-4 h-4 text-black bg-gray-100 border-gray-300 rounded focus:ring-blue-500 dark:focus:ring-blue-600 dark:ring-offset-gray-800 focus:ring-2 dark:bg-gray-700 dark:border-gray-600"
                                    name="categorie[]" type="checkbox" id={key} data-catids={category.id}/>
                                <label className="ml-2 text-sm font-medium text-gray-900 dark:text-gray-300"
                                       htmlFor={key} form="flexCheckDefault">{category.name}</label>
                            </div>
                        )})}
                    <hr className="my-2" />
                    <Label  className="text-md">
                        Prices
                    </Label>
                    <br/>
                    <Label htmlFor="min" className="text-md">
                        Min:
                    </Label>
                    <Input {...register('min')} id="min" type="number" />
                    <Label htmlFor="max" className="text-md">
                        Max:
                    </Label>
                    <Input {...register('max')} id="max" type="number" />
                    <div className="flex justify-center mt-2 ">
                        <button className="focus:outline-none text-white bg-yellow-400 hover:bg-yellow-500 focus:ring-4 focus:ring-yellow-300 font-medium rounded-lg text-sm px-5 py-2.5 mr-2 mb-2 dark:focus:ring-yellow-900 w-full">Filter</button>
                        <button onClick={resetProducts} className="text-white bg-gray-800 hover:bg-gray-900 focus:outline-none focus:ring-4 focus:ring-gray-300 font-medium rounded-lg text-sm px-5 py-2.5 mr-2 mb-2 dark:bg-gray-800 dark:hover-bg-gray-700 dark:focus-ring-gray-700 dark-border-gray-700 w-full">Reset</button>
                    </div>

                </Card>
            </form>
        </>
    );
}

