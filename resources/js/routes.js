import LoginComponent from "./components/Login";
import List from "./components/List";
import Item from "./components/Item";

export const routes = [
    {
        name: 'login',
        path: '/login',
        component: LoginComponent,
        meta: {
            forAuth: false,
            title: 'Login',
        }
    },
    {
        name: 'list',
        path: '/list',
        component: List,
        meta: {
            forAuth: true,
            title: 'List of Currencies',
        }
    },
    {
        name: 'item',
        path: '/currency/:name',
        component: Item,
        props: true,
        meta: {
            forAuth: true,
            title: 'Item',
        }
    }
];
