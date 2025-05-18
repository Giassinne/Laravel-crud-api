import { useState, useEffect } from 'react';
import axios from 'axios';
import { toast, Toaster } from 'react-hot-toast';
import ProductList from './components/ProductList';
import ProductForm from './components/ProductForm';

const API_URL = 'http://localhost:8000/api';

function App() {
    const [products, setProducts] = useState([]);
    const [editingProduct, setEditingProduct] = useState(null);

    useEffect(() => {
        fetchProducts();
    }, []);

    const fetchProducts = async () => {
        try {
            const response = await axios.get(`${API_URL}/products`);
            setProducts(response.data.data);
        } catch (error) {
            toast.error('Failed to fetch products');
        }
    };

    const handleCreate = async (productData) => {
        try {
            await axios.post(`${API_URL}/products`, productData);
            toast.success('Product created successfully');
            fetchProducts();
        } catch (error) {
            toast.error('Failed to create product');
        }
    };

    const handleUpdate = async (id, productData) => {
        try {
            await axios.put(`${API_URL}/products/${id}`, productData);
            toast.success('Product updated successfully');
            setEditingProduct(null);
            fetchProducts();
        } catch (error) {
            toast.error('Failed to update product');
        }
    };

    const handleDelete = async (id) => {
        try {
            await axios.delete(`${API_URL}/products/${id}`);
            toast.success('Product deleted successfully');
            fetchProducts();
        } catch (error) {
            toast.error('Failed to delete product');
        }
    };

    return (
        <div className="min-h-screen bg-gray-100">
            <Toaster position="top-right" />
            <div className="container mx-auto px-4 py-8">
                <h1 className="text-3xl font-bold text-gray-900 mb-8">Product Management</h1>

                <div className="grid grid-cols-1 md:grid-cols-2 gap-8">
                    <div>
                        <h2 className="text-xl font-semibold mb-4">
                            {editingProduct ? 'Edit Product' : 'Add New Product'}
                        </h2>
                        <ProductForm
                            onSubmit={editingProduct ? handleUpdate : handleCreate}
                            initialData={editingProduct}
                            onCancel={() => setEditingProduct(null)}
                        />
                    </div>

                    <div>
                        <h2 className="text-xl font-semibold mb-4">Products List</h2>
                        <ProductList
                            products={products}
                            onEdit={setEditingProduct}
                            onDelete={handleDelete}
                        />
                    </div>
                </div>
            </div>
        </div>
    );
}

export default App;
