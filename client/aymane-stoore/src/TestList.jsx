import React, { useEffect, useState } from 'react';
import List from 'list.js';

export default function TestList() {
    const [listItems, setListItems] = useState([
        { name: 'Jonny', adress: 'Oujda' },
        { name: 'Jonas', adress: 'Casa' },
    ]);

    useEffect(() => {
        const options = {
            valueNames: ['name', 'adress'],
        };

        const hackerList = new List('hacker-list', options);

        // You can update the list dynamically by updating state
        // Example:
        // setListItems([...listItems, { name: 'New Name', adress: 'New Adress' }]);

        // Ensure that List.js cleans up its internal structures when the component unmounts
        return () => {
            hackerList.destroy();
        };
    }, [listItems]);

    return (
        <div id="hacker-list">
            <input className="search" />
            <button className="sort" data-sort="name">
                Sort by name
            </button>
            <button className="sort" data-sort="adress">
                Sort by address
            </button>

            <ul className="list">
                {listItems.map((item, index) => (
                    <li key={index}>
                        <h3 className="name">{item.name}</h3>
                        <p className="adress">{item.adress}</p>
                    </li>
                ))}
            </ul>
        </div>
    );
}
