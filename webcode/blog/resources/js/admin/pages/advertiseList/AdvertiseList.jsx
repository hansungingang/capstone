import {React,useState,useEffect} from 'react'
import { DataGrid } from '@material-ui/data-grid';
import { Link } from 'react-router-dom';
import { useSelector,useDispatch } from 'react-redux';

import { fetchAllAdvertiseListAsync } from '../../reducers/reducer_advertise';

export default function AdvertiseList() { 
    const advertiseLists = useSelector(state => state.allAdvertiseLists)
    const dispatch = useDispatch();

    useEffect(() => {
        // Update the document title using the browser API
        (async () => {
            dispatch(fetchAllAdvertiseListAsync());
        })()
    },[]);

    const columns = [
        { field: 'id', headerName: 'ID', width: 110 },
        { field: 'area_code', headerName: 'AreaCode', width: 200},
        { field: 'area_name', headerName: 'AreaName', width: 200},
        {
            field:"action",
            headerName:"Action",
            width:160,
            renderCell: (params) => {
                return(
                    <>
                    <Link to={"/admin/advertise/" +params.row.id}>
                        <button className="productListEdit">Edit</button>
                    </Link>
                    </>
                )
            }
        },
    ];
  return (
    <div className='productList'>
        <DataGrid
        disableSelectionOnClick
        rows={advertiseLists}
        columns={columns}
        pageSize={8}
        checkboxSelection
      />
    </div>
  )
}
