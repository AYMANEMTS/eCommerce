import {Tabs, TabsContent, TabsList, TabsTrigger} from "../../componets/ui/tabs.jsx";

export default function ProductSection({sections}) {
    return (
        <>
            <Tabs defaultValue="section-0" className="w-full">
                <TabsList>
                    {sections.map((section, index) => (
                        <TabsTrigger key={index} value={`section-${index}`}>
                            {section.nameOfSection}
                        </TabsTrigger>
                    ))}
                </TabsList>
                <div className="tabs-content">
                    {sections.map((section, index) => (
                        <TabsContent key={index} value={`section-${index}`}>
                            <div dangerouslySetInnerHTML={{ __html: section.section }} />
                        </TabsContent>
                    ))}
                </div>
            </Tabs>

        </>
    );
}

