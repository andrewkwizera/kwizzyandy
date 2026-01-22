```mermaid
graph TD
    subgraph "External Environment"
        Drive[Google Drive API]
        Gmail[Gmail API]
        Cal[Calendar API]
    end

    subgraph "Grant Compliance Orchestrator"
        Orch[Deterministic Python Orchestrator]
        LLM[LLM Component - Reasoning Engine]
        
        subgraph "Memory Layer"
            SQL[(SQL State Machine)]
            Context[Short-term Context]
        end

        subgraph "Observability Layer"
            Logs[Audit Logs & Reasoning Traces]
        end
    end

    %% Loop Flow
    Orch -- "1. Observe" --> Drive
    Orch -- "Read State" --> SQL
    Orch -- "2. Reason/Decide" --> LLM
    LLM -- "3. Decide Tool" --> Orch
    Orch -- "4. Act" --> Gmail
    Orch -- "4. Act (Escalate)" --> Cal
    Orch -- "5. Update" --> SQL
    Orch -- "Log Decision" --> Logs
    SQL -- "6. Repeat" --> Orch

    style Orch fill:#f9f,stroke:#333,stroke-width:4px
    style LLM fill:#bbf,stroke:#333
    style SQL fill:#dfd,stroke:#333
