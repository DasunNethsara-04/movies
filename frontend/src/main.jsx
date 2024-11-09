import { StrictMode } from 'react'
import { createRoot } from 'react-dom/client'
import './index.css'
import App from './App.jsx'
import 'bootstrap/dist/css/bootstrap.min.css';
import 'bootstrap/dist/js/bootstrap.bundle.min';

import {
  createBrowserRouter,
  RouterProvider,
} from "react-router-dom";
import BoxOfficeList from './Pages/BoxOfficeList.jsx';
import Marvel from './Pages/Marvel.jsx';

const router = createBrowserRouter([
  {
    path: "/",
    element: <App />,
  },
  {
    path: "/box-office",
    element: <BoxOfficeList />,
  },
  {
    path: "/marvel",
    element: <Marvel />,
  },
]);

createRoot(document.getElementById('root')).render(
  <StrictMode>
    <RouterProvider router={router} />
  </StrictMode>,
)
