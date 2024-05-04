import { Link } from "@inertiajs/inertia-react";
import React from "react";

export default function SingleChat({ messages ,user ,receiver }) {
    console.log(messages);
    return (
        <div className="w-full">
                <div className="h-16 border border-white border-opacity-20 flex items-center">
                    <div className="flex items-center gap-2 px-4">
                        <img
                            src={`/storage/${receiver.image}`}
                            alt=""
                            className="w-12 h-12 object-cover rounded-full"
                        />
                        <h1 className="font-bold">{receiver.name}</h1>
                    </div>
                </div>
                <div className="rounded-lg p-4">
                    {messages ? (
                        messages.map((message) => (
                            <div
                                key={message.id}
                                className={`flex items-start mb-4 ${
                                    message.sender_id === user.id
                                        ? "justify-end"
                                        : ""
                                }`}
                            >
                                {message.sender_id !== user.id && (
                                    <img
                                        src={message.sender.image}
                                        alt={message.sender.name}
                                        className="w-10 h-10 object-cover rounded-full mr-4"
                                    />
                                )}
                                <div>
                                    <div
                                        className={`${
                                            message.sender_id === user.id
                                                ? "bg-[#3797F0]"
                                                : "bg-[#262626]"
                                        } rounded-lg shadow p-2`}
                                    >
                                        <p>{message.message}</p>
                                    </div>
                                    <p className="flex justify-end text-xs text-gray-300">
                                        {message.created_at}
                                    </p>
                                </div>
                            </div>
                        ))
                    ) : (
                        <div className="w-full py-10 flex justify-center">
                        <div className="flex flex-col items-center">
                            <img src={`/storage/${receiver.image}`} alt="" className="w-24 h-24 object-cover rounded-full" />
                            <h1 className="text-lg font-semibold">{receiver.name}</h1>
                            <h1 className="text-gray-500">@{receiver.username}</h1>
                            <button className="p-2 mt-2 bg-blue-500 text-white rounded-md focus:outline-none">Lihat Profile</button>
                        </div>
                    </div>

                    )}
                </div>
                <div className="fixed bottom-0 w-full lg:w-3/4 border-t border-white border-opacity-20 py-4 px-6 gap-4">
                    <form className="flex items-center gap-4">
                        <input type="hidden" name="sender_id" value={user.id} />
                        <input
                            type="hidden"
                            name="receiver_id"
                            value={user.id}
                        />
                        <input
                            type="text"
                            placeholder="Type your message..."
                            name="message"
                            className="w-full px-4 py-2 rounded-lg border text-black border-gray-300 focus:outline-none focus:border-blue-500"
                        />
                        <button
                            type="submit"
                            className="w-fit px-4 py-2 bg-blue-500 text-white rounded-lg hover:bg-blue-600 focus:outline-none focus:bg-blue-600"
                        >
                            Send
                        </button>
                    </form>
                </div>
            </div>
    );
}
