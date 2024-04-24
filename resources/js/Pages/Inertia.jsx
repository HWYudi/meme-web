import React, { useState } from "react";
import { Inertia } from "@inertiajs/inertia";

export default function home({ posts, user }) {
    const [Title, setTitle] = useState("");
    const [Body, setBody] = useState(null);

    const handleSubmit = (e) => {
        e.preventDefault()
        const formData = {
            title : Title,
            body : Body,
        };
        Inertia.post("/inertia", formData , {

        });
    };

    return (
        <div>
        <div className="popup fixed z-40 inset-0 flex items-center hidden justify-center bg-black bg-opacity-80">
            <div className="bg-black rounded-lg p-2 px-5 w-full max-w-md relative">
                <span
                    onClick={togglePopup}
                    className="text-white cursor-pointer"
                >
                    &times;
                </span>
                <form
                    onSubmit={handleSubmit}
                    className="space-y-4"
                    encType="multipart/form-data"
                >
                    <div className="flex">
                        {user && (
                            <img
                                src={"storage/" + user.image}
                                alt=""
                                className="w-12 h-12 object-cover rounded-full"
                            />
                        )}
                        <input
                            type="text"
                            name="title"
                            placeholder="What You Want To Post?"
                            value={Title}
                            onChange={(e) => setTitle(e.target.value)}
                            className="text-white w-full px-4 py-2 rounded-lg focus:outline-none focus:border-blue-500 bg-transparent"
                        />
                    </div>
                    <div>
                        <input
                            id="body"
                            name="body"
                            type="file"
                            onChange={(e) => setBody(e.target.files[0])}
                            className="w-full px-4 py-2 border border-gray-300 rounded-lg focus:outline-none focus:border-blue-500"
                        />
                    </div>
                    <div>
                        <button
                            type="submit"
                            className="w-full px-6 py-3 bg-blue-500 hover:bg-blue-600 text-white rounded-lg shadow-md transition-colors duration-300 ease-in-out"
                        >
                            Submit
                        </button>
                    </div>
                </form>
            </div>
            </div>

        <div>
            {posts.map((post) => (
                <div key={post.id}>
                    <h1>{post.title}</h1>
                    {/* <img src={"storage/" + post.body} alt="" className="w-full"/> */}
                </div>
            ))}
        </div>

        </div>
    );
}
