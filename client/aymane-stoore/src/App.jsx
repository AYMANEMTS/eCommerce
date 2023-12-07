
import RoutesPages from "./Routing/RoutesPages.jsx";
import ShopingCartProvider from "./context/ShopingCartContext.jsx";
import {ThemeProvider} from "@/componets/theme-provider.jsx";
import FavoriteProvider from "@/context/FavorieContext.jsx";


function App() {


  return (
      <ThemeProvider defaultTheme="dark" storageKey="vite-ui-theme">
          <ShopingCartProvider>
              <FavoriteProvider>
                <RoutesPages />
              </FavoriteProvider>
        </ShopingCartProvider>
      </ThemeProvider>
  )
}

export default App
