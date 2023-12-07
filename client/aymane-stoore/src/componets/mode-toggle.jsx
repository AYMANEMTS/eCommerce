import { Moon, Sun } from "lucide-react"

import { Button } from "./ui/button.jsx"
import {
    DropdownMenu,
    DropdownMenuContent,
    DropdownMenuItem,
    DropdownMenuTrigger,
} from "./ui/dropdown-menu"
import { useTheme } from "./theme-provider.jsx"

export function ModeToggle() {
    const { theme,setTheme } = useTheme()

    return (
        <DropdownMenu>
            <Button onClick={setTheme} size="icon">
                {theme === 'light' ?
                    <Sun className="h-[1.2rem] w-[1.2rem] rotate-0 scale-100 transition-all dark:-rotate-90 dark:scale-0" />
                    :
                    <Moon className=" h-[1.2rem] w-[1.2rem] rotate-90 scale-0 transition-all dark:rotate-0 dark:scale-100" />
                }
                <span className="sr-only">Toggle theme</span>
            </Button>
        </DropdownMenu>

    )
}
