import {
    Sheet,
    SheetContent,
    SheetDescription,
    SheetHeader,
    SheetTitle,
    SheetTrigger,
} from "../../../componets/ui/sheet.jsx"
import {useFavoriteContext} from "@/context/FavorieContext.jsx";
import FavoriteItem from "@/myComponets/favorite/ui/FavoriteItem.jsx";

export default function Favorite() {
    const {getCountFavorites} = useFavoriteContext()
    const count = getCountFavorites()
    return (
        <>
            <Sheet>
                <SheetTrigger>
                    <div className="relative">
                        <svg xmlns="http://www.w3.org/2000/svg" className="h-6 w-6" fill="none" viewBox="0 0 24 24" stroke="currentColor">
                            <path strokeLinecap="round" strokeLinejoin="round" strokeWidth="2" d="M4.318 6.318a4.5 4.5 0 000 6.364L12 20.364l7.682-7.682a4.5 4.5 0 00-6.364-6.364L12 7.636l-1.318-1.318a4.5 4.5 0 00-6.364 0z" />
                        </svg>
                        {count > 0 ? (
                            <span className="absolute top-0 right-0 inline-flex items-center justify-center px-2 py-1 text-xs font-bold leading-none text-red-100 transform translate-x-1/2 -translate-y-1/2 bg-red-600 rounded-full">
                                 {count}
                            </span>) : (<span className="flex absolute -mt-5 ml-4">
                            <span className="animate-ping absolute inline-flex h-3 w-3 rounded-full bg-pink-400 opacity-75"></span>
                            <span className="relative inline-flex rounded-full h-3 w-3 bg-pink-500"></span>
                        </span>)}
                    </div>
                </SheetTrigger>

                <SheetContent>
                    <SheetHeader>
                        <SheetTitle>Favorites items</SheetTitle>
                        <SheetDescription>
                            <FavoriteItem />
                        </SheetDescription>
                    </SheetHeader>
                </SheetContent>
            </Sheet>

        </>
    );
}

